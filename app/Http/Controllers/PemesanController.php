<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pemesan;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PemesanController extends Controller
{
    // Halaman utama (beranda)
    public function index()
    {
        return view('pemesan.beranda');
    }

    // Halaman profil pengguna
    public function profil()
    {
        $user = Auth::user();
        return view('pemesan.profil', compact('user'));
    }

    // Proses update profil (dengan crop image support)
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:100',
            'alamat'   => 'nullable|string|max:255',
            'no_telp'  => 'nullable|string|max:20',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cropped_image' => 'nullable|string',
        ]);

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;

        // Hapus foto lama jika ada
        if ($user->gambar && Storage::exists('public/' . $user->gambar)) {
            Storage::delete('public/' . $user->gambar);
        }

        // Jika ada hasil crop (base64)
        if ($request->filled('cropped_image')) {
            $imageData = $request->cropped_image;
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            $imageName = 'foto_profil/' . uniqid() . '.png';

            Storage::disk('public')->put($imageName, base64_decode($image));
            $user->gambar = $imageName;
        } elseif ($request->hasFile('gambar')) {
            // Jika user upload tanpa crop
            $path = $request->file('gambar')->store('foto_profil', 'public');
            $user->gambar = $path;
        }

        $user->save();

        return redirect()->route('pemesan.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // Form pemesanan
    public function form_pesan()
    {
        $layanan = Layanan::all();
        return view('pemesan.form-pesan', compact('layanan'));
    }

    // Simpan pemesanan
    public function store(Request $request)
    {
        Pemesan::create([
            'user_id' => Auth::id(),
            'layanan_id' => $request->layanan,
            'nama_pemesan' => $request->nama,
            'alamat' => $request->alamat,
            'detail_alamat' => $request->detail_alamat,
            'no_telp' => $request->no_telp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pemesan.beranda')->with('success', 'Berhasil Memesan');
    }

    public function riwayat()
{
    $userId = Auth::id();

    $pesananPending = Pemesan::with('layanan_relasi')
        ->where('user_id', $userId)
        ->whereIn('status', ['pending', 'belum bayar'])
        ->orderBy('updated_at', 'desc')
        ->get();

    $pesananProses = Pemesan::with('layanan_relasi')
        ->where('user_id', $userId)
        ->where('status', 'proses')
        ->orderBy('updated_at', 'desc')
        ->get();

    $pesananSelesai = Pemesan::with('layanan_relasi')
        ->where('user_id', $userId)
        ->where('status', 'selesai')
        ->orderBy('updated_at', 'desc')
        ->get();

    return view('pemesan.riwayat', compact('pesananPending', 'pesananProses', 'pesananSelesai'));
}

    public function batalPesanan($id)
    {
        $pemesanan = Pemesan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesan.riwayat')->with('success', 'Data Berhasil Dihapus');
    }

    public function setorUlasan($id, Request $request)
    {
        $pemesanan = Pemesan::findOrFail($id);
        Testimoni::create([
            'user_id' => Auth::id(),
            'pemesanan_id' => $pemesanan->id,
            'komentar' => $request->komentar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pemesan.riwayat')->with('success', 'Berhasil memberi ulasan');
    }

}
