<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Klaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log; // Tambahkan Log untuk debugging

class CustomerController extends Controller
{
    /**
     * Konstruktor: Melindungi method 'klaimItem' dan 'history' 
     * agar hanya bisa diakses oleh user yang sudah login.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('klaimItem', 'history'); 
    }

    /**
     * 1. Menampilkan Katalog Utama (dengan Filter dan Pagination).
     */
    public function index(Request $request)
    {
        // Query Dasar: Ambil SEMUA Item dengan eager loading Kategori
        $query = Item::with('kategori');

        // --- Logika Filtering ---
        
        // Filter Berdasarkan Kategori (Menggunakan 'kategori' untuk sinkronisasi dengan View)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter Berdasarkan Ukuran
        if ($request->filled('ukuran')) {
            $query->where('ukuran', $request->ukuran);
        }

        // Search (Pencarian Berdasarkan Nama Item)
        if ($request->filled('search')) {
            $query->where('nama_item', 'like', '%' . $request->search . '%');
        }

        // --- Logika Filtering Status ---
        // Status yang ditampilkan secara default adalah 'Tersedia' dan 'Diproses'
        $statusFilter = $request->get('status');
        
        if ($statusFilter === 'Klaim') {
            // Jika filter 'Sudah Diklaim' dipilih
            $query->whereIn('status', ['Diproses', 'Terjual']); 
        } elseif ($statusFilter === 'Tersedia') {
            // Jika filter 'Tersedia' dipilih
            $query->where('status', 'Tersedia'); 
        } else {
            // Jika filter status tidak dipilih (default), tampilkan item yang masih aktif di katalog
            // Ini memastikan item baru (dengan status 'Tersedia') dan item yang sedang diklaim ('Diproses') muncul.
            $query->whereIn('status', ['Tersedia', 'Diproses']);
        }

        // --- Logika Filtering Koleksi (New Arrivals / Best Seller / Sale) ---
        $koleksi = $request->get('koleksi');
        if ($koleksi === 'new') {
            // Item yang ditambahkan dalam 14 hari terakhir
            $query->where('created_at', '>=', now()->subDays(14));
        } elseif ($koleksi === 'bestseller') {
            // Item yang paling banyak diklaim (terjual)
            $query->where('status', 'Terjual');
        } elseif ($koleksi === 'sale') {
            // Item yang memiliki harga diskon
            $query->whereNotNull('harga_diskon')->where('harga_diskon', '>', 0);
        }


        // --- Logika Sorting ---
        $sort = $request->get('sort');

        if ($sort === 'asc') {
            $query->orderBy('harga', 'asc'); // Termurah
        } elseif ($sort === 'desc') {
            $query->orderBy('harga', 'desc'); // Termahal
        } else {
            // Default: Urutkan Terbaru
            $query->latest(); 
        }

        // Ambil data dan terapkan pagination, pertahankan query string
        $items = $query->paginate(12)->withQueryString();

        $kategoris = Kategori::all();

        // Hitung badge angka untuk tiap koleksi
        $countNew = Item::where('created_at', '>=', now()->subDays(14))->whereIn('status', ['Tersedia', 'Diproses'])->count();
        $countSale = Item::whereNotNull('harga_diskon')->where('harga_diskon', '>', 0)->whereIn('status', ['Tersedia', 'Diproses'])->count();
        $countSold = Item::where('status', 'Terjual')->count();

        return view('customer.katalog.index', compact('items', 'kategoris', 'countNew', 'countSale', 'countSold'));
    }

    /**
     * 2. Menampilkan Halaman Detail Produk.
     */
    public function show(Item $item)
    {
        // Pastikan Item yang ditampilkan memang tersedia/aktif, atau redirect
        if ($item->status === 'Terjual') {
            return redirect()->route('katalog.index')->with('error', 'Item ini sudah terjual.');
        }

        $item->load('kategori'); // Pastikan relasi kategori dimuat
        return view('customer.katalog.show', compact('item'));
    }

    /**
     * 3. Memproses Workflow Klaim Item (Transaksi Kritis).
     */
    public function klaimItem(Request $request, Item $item)
    {
        // 3.0. Validasi Alamat Pengiriman
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:10|max:1000'
        ], [
            'alamat_pengiriman.required' => 'Alamat pengiriman wajib diisi agar barang bisa dikirim!',
            'alamat_pengiriman.min' => 'Alamat terlalu singkat, mohon isi alamat dengan jelas.'
        ]);

        // 3.1. Validasi Pra-Klaim
        if ($item->status !== 'Tersedia') {
            return back()->with('error', 'Item sudah tidak tersedia untuk diklaim.');
        }

        // Cek apakah user sudah pernah mengklaim item ini dan masih aktif (Diproses/Menunggu)
        $klaimSudahAda = Klaim::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->whereIn('status_klaim', ['Menunggu Konfirmasi', 'Diproses']) 
            ->exists();

        if ($klaimSudahAda) {
             return back()->with('error', 'Anda sudah memiliki klaim aktif untuk item ini.');
        }


        // Gunakan Transaction untuk memastikan kedua operasi berhasil atau gagal bersamaan
        DB::beginTransaction();
        try {
            // 3.2. Update Status Item (Mengunci Stok)
            $item->update(['status' => 'Diproses']);

            // 3.3. Buat Record Klaim Baru beserta Alamat Pengiriman
            Klaim::create([
                'user_id' => Auth::id(), // ID User yang sedang login
                'item_id' => $item->id,
                'status_klaim' => 'Menunggu Konfirmasi',
                'tgl_klaim' => now(),
                'alamat_pengiriman' => $request->alamat_pengiriman
            ]);

            DB::commit();

            return redirect()->route('customer.klaim.index')->with('success', 'Klaim pesanan berhasil! Silakan pantau status persetujuannya di Dasbor Anda.'); 
        
        } catch (\Exception $e) {
            DB::rollback(); // Jika gagal, kembalikan status item
            
            // Log error untuk debugging (SANGAT DISARANKAN)
            Log::error('Klaim Gagal untuk Item ID ' . $item->id . ': ' . $e->getMessage()); 
            
            return back()->with('error', 'Terjadi kesalahan saat klaim. Coba lagi.'); 
        }
    }

    /**
     * 4. Menampilkan Detail Klaim.
     */
    public function showKlaim($id)
    {
        $klaim = Klaim::with('item.kategori')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('customer.riwayat-klaim.show', compact('klaim'));
    }

    /**
     * 5. Menampilkan Form Edit Klaim (Catatan Pembeli)
     */
    public function editKlaim($id)
    {
        return back()->with('error', 'Fitur pengeditan catatan sedang dalam pengembangan.');
    }

    /**
     * 6. Update Data Klaim
     */
    public function updateKlaim(Request $request, $id)
    {
        return back()->with('success', 'Klaim berhasil diupdate.');
    }

    /**
     * 7. Membatalkan (Hapus) Pesanan Klaim
     */
    public function destroyKlaim($id)
    {
        // Pastikan hanya klaim yang masih Menunggu Konfirmasi / Pending yang bisa dibatalkan
        $klaim = Klaim::with('item')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('status_klaim', ['Menunggu Konfirmasi', 'Pending'])
            ->firstOrFail();

        DB::beginTransaction();
        try {
            if ($klaim->item) {
                // Kembalikan item ke status Tersedia agar bisa dibeli orang lain
                $klaim->item->update(['status' => 'Tersedia']);
            }
            $klaim->delete();
            DB::commit();
            return redirect()->route('customer.klaim.index')->with('success', 'Pesanan tagihan berhasil dibatalkan dan status stok dikembalikan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Cancel Klaim Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membatalkan pesanan.');
        }
    }

    /**
     * 8. Menampilkan Riwayat Klaim User.
     */
    public function history(Request $request)
    {
        $userId = Auth::id();

        // 1. Setup Query Dasar
        $query = Klaim::with('item')->where('user_id', $userId);

        // 2. Terapkan Filter berdasarkan status yang di-klik
        $statusFilter = $request->get('status');
        if ($statusFilter === 'diproses') {
            $query->whereIn('status_klaim', ['Menunggu Konfirmasi', 'Diproses', 'Pending']);
        } elseif ($statusFilter === 'dikirim') {
            $query->where('status_klaim', 'Dikirim');
        } elseif ($statusFilter === 'selesai') {
            $query->where('status_klaim', 'Selesai');
        }

        // Ambil data (Terapkan filter & Pagination)
        $riwayatKlaim = $query->latest()->paginate(10)->withQueryString();

        // Hitung statistik pesanan
        $countProses = Klaim::where('user_id', $userId)
            ->whereIn('status_klaim', ['Menunggu Konfirmasi', 'Diproses', 'Pending'])
            ->count();
            
        $countKirim = Klaim::where('user_id', $userId)
            ->where('status_klaim', 'Dikirim')
            ->count();
            
        $countSelesai = Klaim::where('user_id', $userId)
            ->where('status_klaim', 'Selesai')
            ->count();

        // Asumsi view Anda berada di 'customer.riwayat-klaim.index'
        return view('customer.riwayat-klaim.index', compact('riwayatKlaim', 'countProses', 'countKirim', 'countSelesai'));
    }
}