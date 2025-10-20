<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pemesan;
use App\Models\PemesananDetail;
use App\Models\Users;
use Illuminate\Http\Request;
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

        $pemesan->save();

        return redirect()->route('admin.pemesanan')->with('success', 'Data layanan berhasil diperbarui.');
    }
}
