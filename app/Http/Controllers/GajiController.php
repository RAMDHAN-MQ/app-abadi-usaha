<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\PemesananDetail;
use App\Models\Users;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('pekerja_relasi')->orderBy('periode_start', 'desc')->get();

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

        return redirect()->route('admin.gaji')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function bayarGaji($id)
    {
        $gaji = Gaji::findOrFail($id);

        $gaji->update([
            'status' => 'Lunas'
        ]);

        return back()->with('success', 'Gaji berhasil dibayar');
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

    public function generateGajiMingguan()
    {
        // 1. Tentukan Periode: Hitung gaji untuk MINGGU LALU
        $start = Carbon::now()->subWeek()->startOfWeek();
        $end = Carbon::now()->subWeek()->endOfWeek()->endOfDay(); // Pastikan mencakup akhir hari terakhir

        $startDateString = $start->format('Y-m-d');
        $endDateString = $end->format('Y-m-d');

        // 2. Ambil Pekerja yang Memiliki Pekerjaan Minggu Lalu (Efisiensi)
        $pekerjaIds = PemesananDetail::whereBetween('created_at', [$start, $end])
            ->whereNotNull('gaji_karyawan')
            ->distinct('pekerja_id')
            ->pluck('pekerja_id');

        if ($pekerjaIds->isEmpty()) {
            return back()->with('info', 'Tidak ada pekerjaan yang diselesaikan pada periode tersebut.');
        }

        $users = Users::whereIn('id', $pekerjaIds)->get();

        // 3. Proses Perhitungan
        DB::beginTransaction();
        try {
            foreach ($users as $user) {
                // Cek apakah periode sudah dibuat (hanya 1 query per user yang tersisa)
                $existing = Gaji::where('user_id', $user->id)
                    ->where('periode_start', $startDateString)
                    ->where('periode_end', $endDateString)
                    ->first();

                if ($existing) {
                    continue; // Skip user ini jika periode sudah dibuat
                }

                // Ambil dan Agregasi data pekerjaan untuk user ini
                $jobs = PemesananDetail::where('pekerja_id', $user->id)
                    ->whereBetween('created_at', [$start, $end])
                    ->whereNotNull('gaji_karyawan')
                    ->get();

                // Harusnya sudah ada karena user diambil dari $pekerjaIds, tapi ini adalah cek keamanan
                if ($jobs->count() === 0) continue;

                Gaji::create([
                    'user_id'         => $user->id,
                    'totalKaryawan'   => $jobs->sum('gaji_karyawan'),
                    'periode_start'   => $startDateString,
                    'periode_end'     => $endDateString,
                    'status'          => 'Belum Lunas',
                ]);
            }

            DB::commit();
            return back()->with('success', 'Gaji mingguan periode ' . $startDateString . ' sampai ' . $endDateString . ' berhasil dihitung.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gaji Generation Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghitung gaji: ' . $e->getMessage());
        }
    }

    // flutter

    public function showByUser($user_id)
    {
        // Ambil semua gaji user
        $gaji = Gaji::where('user_id', $user_id)
            ->orderBy('periode_start', 'desc')
            ->get();

        if ($gaji->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => [],
            ]);
        }

        // Grouping berdasarkan periode_start dan periode_end
        $periodeGrouped = $gaji->groupBy(function ($item) {
            return $item->periode_start . '|' . $item->periode_end;
        });

        $data = [];

        foreach ($periodeGrouped as $periodeKey => $items) {
            $periodeStart = $items->first()->periode_start ?? '-';
            $periodeEnd = $items->first()->periode_end ?? '-';
            $jumlahPekerjaan = $items->count();
            $totalPendapatan = $items->sum(fn($i) => $i->totalKaryawan ?? 0);
            $statusTerakhir = $items->last()?->status ?? '-';

            $data[] = [
                'periode_start' => $periodeStart,
                'periode_end' => $periodeEnd,
                'jumlah_pekerjaan' => $jumlahPekerjaan,
                'total_pendapatan' => $totalPendapatan,
                'status_terakhir' => $statusTerakhir,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
