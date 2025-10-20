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
            ->where('status', 'Selesai')
            ->sum(DB::raw('harga + ongkir'));

        // Total pelanggan unik
        $totalCustomers = Pemesan::select('user_id')->distinct()->count();

        // Data chart keuntungan per bulan
        $chartKeuntungan = Pemesan::selectRaw('MONTH(created_at) as bulan, SUM(harga + ongkir) as total')
            ->where('status', 'Selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Layanan paling sering dipesan
        $chartLayanan = Pemesan::selectRaw('layanan_id, COUNT(*) as total')
            ->groupBy('layanan_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Data Pemesan terbaru
        $latestOrders = Pemesan::with('layanan')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'todayOrders', 'todayIncome', 'totalCustomers', 'chartKeuntungan', 'chartLayanan', 'latestOrders'
        ));
    }
}
