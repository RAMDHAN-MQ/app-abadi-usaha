<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::all();
        return view('admin.gaji.index', compact('gaji'));
    }
    public function create()
    {
        return view('admin.gaji.create');
    }

    public function store(Request $request)
    {
        Gaji::create([
            'nama_petugas' => $request->nama_petugas,
            'status_gaji' => $request->status_gaji,
            'pemesanan' => $request->pemesanan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        return view('admin.gaji.edit', compact('gaji'));
    }

    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        $gaji->nama_petugas = $request->nama_petugas;
        $gaji->status_gaji = $request->status_gaji;
        $gaji->pemesanan = $request->pemesanan;
        $gaji->save();

        return redirect()->route('admin.gaji')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function updateGaji($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->status = 'Lunas';
        $gaji->updated_at = now();
        $gaji->save();

        return redirect()->route('admin.gaji')->with('success', 'Data layanan berhasil diperbarui.');
    }

    public function show($id)
    {
        $gaji = Gaji::findOrFail($id);
        return view('admin.gaji.lihat', compact('gaji'));
    }

    public function destroy($id)
    {
        $petugas = Gaji::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.gaji')->with('success', 'Data Berhasil Dihapus');
    }

    // flutter

    public function showByUser($user_id)
    {
        $gaji = Gaji::with(['pemesanan_relasi.layanan_relasi'])
            ->where('user_id', $user_id)
            ->whereHas('pemesanan_relasi', function ($query) {
                $query->where('status', 'selesai');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPendapatan = $gaji->sum('gaji_karyawan');
        $jumlahPekerjaan = $gaji->count();

        $data = $gaji->map(function ($item) {
            return [
                'tanggal' => $item->created_at->format('Y-m-d'),
                'pendapatan' => $item->gaji_karyawan,
                'status' => $item->status,
                'pemesanan' => [
                    'nama_pemesan' => $item->pemesanan_relasi->nama_pemesan ?? '-',
                    'layanan' => $item->pemesanan_relasi->layanan_relasi->nama_layanan ?? '-',
                ],
            ];
        });

        return response()->json([
            'success' => true,
            'total_pendapatan' => $totalPendapatan,
            'jumlah_pekerjaan' => $jumlahPekerjaan,
            'data' => $data,
        ]);
    }
}
