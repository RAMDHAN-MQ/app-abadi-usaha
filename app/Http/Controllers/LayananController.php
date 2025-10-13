<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconname = time() . '_' . $icon->getClientOriginalName();
            $icon->storeAs('icon_layanan', $iconname, 'public');
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'keterangan' => $request->keterangan,
            'harga' => $request->harga,
            'icon' => $iconname ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Data Berhasil Ditambah');
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.lihat', compact('layanan'));
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        if ($layanan->icon && Storage::disk('public')->exists('icon_layanan/' . $layanan->icon)) {
            Storage::disk('public')->delete('icon_layanan/' . $layanan->icon);
        }
        $layanan->delete();

        return redirect()->route('admin.layanan')->with('success', 'Data Berhasil Dihapus');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('icon_layanan', 'public');
            $layanan->icon = $iconPath;
        }

        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->harga = $request->harga;
        $layanan->keterangan = $request->keterangan;
        $layanan->save();

        return redirect()->route('admin.layanan')->with('success', 'Data layanan berhasil diperbarui.');
    }
}
