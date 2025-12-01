<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Pemesan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Ambil data layanan
        $layanan = Layanan::findOrFail($request->layanan);
        $harga = $layanan->harga;
        $totalHarga = (int)$request->total_harga;

        // Simpan data pemesanan ke tabel `pemesanan`
        $pemesan = Pemesan::create([
            'user_id' => Auth::id(),
            'nama_pemesan' => $request->nama,
            'layanan_id' => $layanan->id,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jarak_pipa' => $request->jarak,
            'harga' => $harga,
            'total' => $totalHarga,
            'status' => 'pending',
        ]);

        // Data untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pemesan->id . '-'. time(),
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => $pemesan->nama_pemesan,
                'email' => Auth::user()->email,
                'phone' => $pemesan->no_telp,
            ],
            'item_details' => [
                [
                    'id' => $layanan->id,
                    'price' => $harga,
                    'quantity' => 1,
                    'name' => $layanan->nama_layanan,
                ],
                [
                    'id' => 'JARAK',
                    'price' => $totalHarga - $harga,   // selisih jarak
                    'quantity' => 1,
                    'name' => "Biaya tambahan jarak"
                ]
            ]

        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Kirim Snap Token ke frontend
        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $pemesan->id
        ]);
    }

    public function callback(Request $request)
    {
        // Inisialisasi konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        $notif = new Notification();

        $status = $notif->transaction_status;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        // Ambil id pemesanan dari order_id
        $id = str_replace('ORDER-', '', $order_id);
        $pemesanan = Pemesan::find($id);

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        // Update status di database sesuai status pembayaran
        if ($status == 'capture') {
            if ($fraud == 'challenge') {
                $pemesanan->status = 'challenge';
            } else {
                $pemesanan->status = 'paid';
            }
        } elseif ($status == 'settlement') {
            $pemesanan->status = 'paid';
        } elseif ($status == 'pending') {
            $pemesanan->status = 'pending';
        } elseif ($status == 'deny') {
            $pemesanan->status = 'deny';
        } elseif ($status == 'expire') {
            $pemesanan->status = 'expired';
        } elseif ($status == 'cancel') {
            $pemesanan->status = 'cancelled';
        }

        $pemesanan->save();

        return response()->json(['message' => 'Callback processed successfully']);
    }

    public function cancelTransaction(Request $request)
    {
        $orderId = $request->order_id;

        $pemesanan = Pemesan::find($orderId);

        if ($pemesanan) {
            $pemesanan->status = 'belum bayar';
            $pemesanan->save();
        }

        return response()->json(['message' => 'Transaksi dibatalkan, status diperbarui ke belum bayar.']);
    }

    public function payAgain(Request $request)
    {
        $pemesanan = Pemesan::findOrFail($request->id);
        $layanan = $pemesanan->layanan_relasi;

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pemesanan->id,
                'gross_amount' => $pemesanan->harga,
            ],
            'customer_details' => [
                'first_name' => $pemesanan->nama_pemesan,
                'email' => Auth::user()->email,
                'phone' => $pemesanan->no_telp,
            ],
            'item_details' => [
                [
                    'id' => $layanan->id,
                    'price' => $pemesanan->harga,
                    'quantity' => 1,
                    'name' => $layanan->nama_layanan,
                ]
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $pemesanan->id
        ]);
    }

    public function updateStatus(Request $request)
    {
        $pemesanan = Pemesan::find($request->order_id);

        if (!$pemesanan) {
            return response()->json(['message' => 'Pemesanan tidak ditemukan'], 404);
        }

        $pemesanan->status = $request->status;
        $pemesanan->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }



}
