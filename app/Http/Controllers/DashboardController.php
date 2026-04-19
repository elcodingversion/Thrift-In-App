<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Item;
use App\Models\Klaim;
use App\Models\Kategori;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Statistik Item
        $totalItems = Item::count();
        $itemsTersedia = Item::where('status', 'Tersedia')->count();
        $itemsTerjual = Item::where('status', 'Terjual')->count();

        // 2. Statistik Klaim / Pesanan
        $totalOrders = Klaim::count();
        $ordersMenunggu = Klaim::where('status_klaim', 'Menunggu Konfirmasi')->count();
        $ordersDiproses = Klaim::where('status_klaim', 'Diproses')->count();
        $ordersDikirim = Klaim::where('status_klaim', 'Dikirim')->count();
        $ordersSelesai = Klaim::where('status_klaim', 'Selesai')->count();
        $ordersBatal = Klaim::where('status_klaim', 'Dibatalkan')->count();

        // 3. Statistik Lainnya
        $activeCategories = Kategori::count();
        $totalUsers = User::count();

        // 4. Estimasi Revenue (item terjual)
        $revenue = Item::where('status', 'Terjual')->sum('harga');

        // 5. Klaim Terbaru (Tabel)
        $recentClaims = Klaim::with(['user', 'item'])
                            ->latest()
                            ->limit(5)
                            ->get();

        // 6. Item Terbaru ditambahkan
        $recentItems = Item::with('kategori')
                          ->latest()
                          ->limit(5)
                          ->get();

        return view('admin.dashboard', compact(
            'totalItems', 'itemsTersedia', 'itemsTerjual',
            'totalOrders', 'ordersMenunggu', 'ordersDiproses', 'ordersDikirim', 'ordersSelesai', 'ordersBatal',
            'activeCategories', 'totalUsers', 'revenue',
            'recentClaims', 'recentItems'
        ));
    }
}