<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Gaji;
use App\Models\Pemesan;
use App\Models\PemesananDetail;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PemesanAdminController extends Controller
{
    public function index()
    {
        $pemesan = Pemesan::all();
        $petugas = Users::where('role', 'petugas')->get();
        return view('admin.pemesanan.index', compact('pemesan', 'petugas'));
    }

    public function create()
    {
        $layanan = Layanan::all();
        return view('admin.pemesanan.create', compact('layanan'));
    }

    public function store(Request $request)
    {
        Pemesan::create([
            'nama_pemesan' => $request->nama_pemesan,
            'layanan_id' => $request->layanan,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'status' => 'pending',
            'jarak_pipa' => $request->jarak,
            'harga' => $request->harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.pemesanan')->with('success', 'Data Berhasil Ditambah');
    }

    public function storePetugas(Request $request)
    {

        $petugas = array_filter([
            $request->petugas1,
            $request->petugas2,
            $request->petugas3,
        ]);

        foreach ($petugas as $id) {
            PemesananDetail::create([
                'pemesanan_id' => $request->pemesanan_id,
                'pekerja_id' => $id,
            ]);
        }

        $pemesan = Pemesan::findOrFail($request->pemesanan_id);
        $pemesan->status = 'proses';
        $pemesan->save();

        return redirect()->route('admin.pemesanan')->with('success', 'Petugas berhasil ditugaskan');
    }

    public function show($id)
    {
        $pemesanan = Pemesan::findOrFail($id);
        $pekerja = PemesananDetail::where('pemesanan_id', $id)->get();
        return view('admin.pemesanan.lihat', compact('pemesanan', 'pekerja'));
    }

    public function destroy($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        $pemesan->delete();
        return redirect()->route('admin.pemesanan')->with('success', 'Data Berhasil Dihapus');
    }

    public function edit($id)
    {
        $pemesanan = Pemesan::findOrFail($id);
        $layanan = Layanan::all();
        return view('admin.pemesanan.edit', compact('pemesanan', 'layanan'));
    }

    public function update(Request $request, $id)
    {
        $pemesan = Pemesan::findOrFail($id);

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icon_layanan', 'public');
            $pemesan->icon = $iconPath;
        }

        $pemesan->nama_pemesan = $request->nama_pemesanan;
        $pemesan->layanan_id = $request->layanan;
        $pemesan->no_telp = $request->nomor_hp;
        $pemesan->alamat = $request->alamat;
        $pemesan->harga = $request->harga;

        $pemesan->save();

        return redirect()->route('admin.pemesanan')->with('success', 'Data layanan berhasil diperbarui.');
    }

    //  flutter

    public function ambilPesanan($pekerjaId)
    {
        $pesanan = DB::table('pemesanan as p')
            ->join('detail_pemesanan as d', 'p.id', '=', 'd.pemesanan_id')
            ->join('layanan as l', 'p.layanan_id', '=', 'l.id')
            ->select(
                'p.id as pesanan_id',
                'p.no_telp',
                'p.alamat',
                'l.nama_layanan',
                'd.id as detail_id',
                'd.verifikasi',
                'd.alasan'
            )
            ->where('d.pekerja_id', $pekerjaId)
            ->whereNull('d.verifikasi')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $pesanan
        ]);
    }

    public function updateVerifikasi(Request $request, $detailId)
    {
        $request->validate([
            'verifikasi' => 'required|in:terima,tolak',
        ]);

        // Update kolom verifikasi di detail_pemesanan
        DB::table('detail_pemesanan')
            ->where('id', $detailId)
            ->update([
                'verifikasi' => $request->verifikasi
            ]);

        // Ambil id pemesanan yang terkait dengan detail ini
        $idpemesanan = DB::table('detail_pemesanan')
            ->where('id', $detailId)
            ->value('pemesanan_id'); // gunakan value() untuk ambil 1 kolom

        // Update status pemesanan menjadi "proses"
        if ($idpemesanan) {
            DB::table('pemesanan')
                ->where('id', $idpemesanan)
                ->update(['status' => 'proses']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Verifikasi berhasil diupdate'
        ]);
    }


    // riwayat

    public function getPesananByPekerja($pekerja_id)
    {
        $data = PemesananDetail::with(['detail_pemesanan_relasi.layanan_relasi'])
            ->where('pekerja_id', $pekerja_id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'status' => $item->detail_pemesanan_relasi->status,
                    'nama_layanan' => $item->detail_pemesanan_relasi->layanan_relasi->nama_layanan ?? '-',
                    'no_telp' => $item->detail_pemesanan_relasi->no_telp,
                    'alamat' => $item->detail_pemesanan_relasi->alamat,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function updateStatus($id, Request $request)
    {
        $detail = PemesananDetail::find($id);

        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $pemesanan = $detail->detail_pemesanan_relasi;

        if (!$pemesanan) {
            return response()->json(['message' => 'Data pemesanan tidak ditemukan'], 404);
        }

        $pemesanan->status = $request->status ?? 'selesai';
        $pemesanan->save();

        if ($pemesanan->status === 'selesai') {
            $pendapatan = $pemesanan->harga ?? 0;
            if ($pemesanan->layanan_id == 2) {
                $gaji_karyawan = 75000;
            } else {
                $gaji_karyawan = 125000;
            }

            $semuaDetail = PemesananDetail::where('pemesanan_id', $pemesanan->id)->get();

            foreach ($semuaDetail as $d) {
                // Set semua verifikasi pekerja menjadi selesai
                $d->verifikasi = 'selesai';
                $d->save();

                Gaji::create([
                    'user_id' => $d->pekerja_id,
                    'pemesanan_id' => $pemesanan->id,
                    'pendapatan' => $pendapatan,
                    'gaji_karyawan' => $gaji_karyawan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui dan data gaji ditambahkan',
            ]);
        }
    }
}
