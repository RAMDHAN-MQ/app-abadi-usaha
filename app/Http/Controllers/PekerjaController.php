<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PekerjaController extends Controller
{
    public function index()
    {
        $petugas = Users::where('role','petugas')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarname = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('gambar_users', $gambarname, 'public');
        }

        Users::create([
            'name' => $request->name,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
            'job' => $request->job,
            'no_rekening' => $request->no_rekening,
            'gambar' => $gambarname,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.petugas')->with('success', 'Data Berhasil Ditambah');
    }

    public function show($id)
    {
        $petugas = Users::findOrFail($id);
        return view('admin.petugas.lihat', compact('petugas'));
    }

    public function destroy($id)
    {
        $petugas = Users::findOrFail($id);
        if ($petugas->gambar && Storage::disk('public')->exists('gambar_users/' . $petugas->gambar)) {
            Storage::disk('public')->delete('gambar_users/' . $petugas->gambar);
        }
        $petugas->delete();

        return redirect()->route('admin.petugas')->with('success', 'Data Berhasil Dihapus');
    }

    public function edit($id)
    {
        $petugas = Users::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Users::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($petugas->gambar && Storage::disk('public')->exists('gambar_users/' . $petugas->gambar)) {
                Storage::disk('public')->delete('gambar_users/' . $petugas->gambar);
            }

            $gambar = $request->file('gambar');
            $gambarname = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('gambar_users', $gambarname, 'public');
            $petugas->gambar = $gambarname;
        }

        $petugas->name = $request->name;
        $petugas->status = $request->status;
        $petugas->email = $request->email;
        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }
        $petugas->job = $request->job;
        $petugas->no_rekening = $request->no_rekening;
        $petugas->updated_at = now();
        $petugas->save();

        return redirect()->route('admin.petugas')->with('success', 'Data Berhasil Diupdate');
    }
}
