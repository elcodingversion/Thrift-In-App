<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Kategori;

class KatalogController extends Controller
{
    /**
     * Menampilkan daftar item dengan fitur filtering dan sorting.
     */
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk filter pills di view
        $kategoris = Kategori::all(); 

        // 2. Query Utama dengan Eager Loading relasi 'kategori'
        $query = Item::with('kategori');

        // 3. Logika Pencarian/Filter Kategori (kategori_id)
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // 4. Logika Filter Status
        if ($request->filled('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // 5. Logika Sorting Harga (Urutan default adalah item terbaru)
        $sortOrder = $request->get('sort');
        
        if ($sortOrder === 'asc') {
            $query->orderBy('harga', 'asc'); // Termurah
        } elseif ($sortOrder === 'desc') {
            $query->orderBy('harga', 'desc'); // Termahal
        } else {
            // Default: Urutkan berdasarkan item terbaru (Created at Descending)
            $query->latest(); 
        }

        // 6. Ambil Data dan Paginate, sertakan semua query string yang aktif
        $items = $query->paginate(8)->withQueryString(); 

        // Kirim data ke view (Pastikan view Anda berada di 'katalog.index')
        return view('katalog.index', compact('items', 'kategoris'));
    }
}