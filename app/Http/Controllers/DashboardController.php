<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Pemesan hari ini
        $todayOrders = Pemesan::whereDate('created_at', Carbon::today())->count();

        // Pendapatan hari ini
        $todayIncome = Pemesan::whereDate('created_at', Carbon::today())
            ->where('status', 'selesai')
            ->sum(DB::raw('harga + ongkir'));

        // Total pelanggan unik
        $totalCustomers = Pemesan::select('user_id')->distinct()->count();

        // Data chart keuntungan per bulan
        $chartKeuntungan = Pemesan::selectRaw('MONTH(created_at) as bulan, SUM(harga + ongkir) as total')
            ->where('status', 'selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy(fn($item) => (int) $item->bulan) // key integer
            ->pluck('total', 'bulan');


        $bulanArray = [];
        $pendapatanArray = [];

        foreach (range(1, 12) as $i) {
            $bulanArray[] = Carbon::create()->month($i)->format('M');
            $pendapatanArray[] = $chartKeuntungan[$i] ?? 0;
        }

        // Layanan paling sering dipesan
        $chartLayanan = Pemesan::with('layanan_relasi')
            ->selectRaw('layanan_id, COUNT(*) as total')
            ->groupBy('layanan_id')
            ->orderByDesc('total')
            ->get();

        $labelsLayanan = $chartLayanan->map(fn($item) => $item->layanan_relasi->nama_layanan ?? 'Unknown');
        $totalsLayanan = $chartLayanan->pluck('total');


        // Data Pemesan terbaru
        $pemesanTerbaru = Pemesan::with('layanan_relasi')->latest()->first();

        return view('admin.dashboard', compact(
            'todayOrders',
            'todayIncome',
            'totalCustomers',
            'chartKeuntungan',
            'labelsLayanan',
            'totalsLayanan',
            'bulanArray',
            'pendapatanArray',
            'pemesanTerbaru'
        ));
    }
}
