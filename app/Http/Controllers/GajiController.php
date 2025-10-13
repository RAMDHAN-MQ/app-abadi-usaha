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
    public function show($id)
    {
        $gaji = Gaji::findOrFail($id);
        return view('admin.gaji.lihat', compact('gaji'));
    }
}
