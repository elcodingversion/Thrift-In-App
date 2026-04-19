<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item; 
use App\Models\Kategori; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rule; 

class ItemController extends Controller
{
    /**
     * 1. READ: Menampilkan daftar semua Item (dengan Search & Filter)
     */
    public function index(Request $request) 
    {
        // PERBAIKAN: Menghapus alias 'name' agar konsisten dengan $category->nama_kategori di view.
        // Jika Anda ingin menggunakan $category->name di view, gunakan Opsi 2.
        $categories = Kategori::select('id', 'nama_kategori')->get(); 
        
        $query = Item::with('kategori'); // Eager load relasi
        
        // --- Logika Pencarian (Search) ---
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Mencari berdasarkan nama_item, deskripsi, atau SKU (jika ada)
                $q->where('nama_item', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }
        
        // --- Logika Filter Kategori ---
        if ($request->filled('category_id') && $request->category_id != '') {
            $query->where('kategori_id', $request->category_id);
        }

        // --- Logika Filter Status ---
        if ($request->filled('status') && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Mengambil data, mengurutkan terbaru, paginate, dan mempertahankan query string filter/search
        $items = $query->latest()->paginate(10)->withQueryString(); 

        // Mengirimkan kedua variabel ke view
        return view('admin.items.index', compact('items', 'categories'));
    }

    /**
     * 2. CREATE: Menampilkan Form Input Item baru
     */
    public function create()
    {
        $categories = Kategori::all(); 
        return view('admin.items.create', compact('categories'));
    }

    /**
     * 3. STORE: Menyimpan Item baru ke database 
     */
    public function store(Request $request)
    {
        // 3.1. Validasi Data
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_item' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:1000',
            'ukuran' => 'required|max:50',
            'status' => 'required|in:Tersedia,Diproses,Terjual',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        
        // 3.2. Handle File Upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $validatedData['foto_path'] = $path;
        }

        // Hapus 'foto' dari array jika ada untuk mencegah error mass assignment
        if (isset($validatedData['foto'])) {
              unset($validatedData['foto']);
        }
        
        // 3.3. Simpan Data ke Database
        Item::create($validatedData);

        return redirect()->route('admin.items.index')->with('success', 'Item baru berhasil ditambahkan!');
    }

    /**
     * 4. SHOW: Menampilkan detail (Opsional)
     */
    public function show(Item $item)
    {
        return view('admin.items.show', compact('item'));
    }

    /**
     * 5. EDIT: Menampilkan Form Edit
     */
    public function edit(Item $item)
    {
        $categories = Kategori::all(); 
        return view('admin.items.edit', compact('item', 'categories'));
    }

    /**
     * 6. UPDATE: Memperbarui Item
     */
    public function update(Request $request, Item $item)
    {
        // 6.1. Validasi Data
        $validatedData = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_item' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:1000',
            'ukuran' => 'required|max:50',
            'status' => 'required|in:Tersedia,Diproses,Terjual',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
        
        // 6.2. Handle File Update
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($item->foto_path && Storage::disk('public')->exists($item->foto_path)) {
                Storage::disk('public')->delete($item->foto_path);
            }
            
            // Upload foto baru
            $path = $request->file('foto')->store('photos', 'public');
            $validatedData['foto_path'] = $path;
        }
        
        // Hapus 'foto' dari validatedData
        if (isset($validatedData['foto'])) {
              unset($validatedData['foto']);
        }

        // 6.3. Update Data
        $item->update($validatedData);

        return redirect()->route('admin.items.index')->with('success', 'Item berhasil diperbarui!');
    }

    /**
     * 7. DELETE: Menghapus Item
     */
    public function destroy(Item $item)
    {
        // 7.1. Hapus Foto dari Storage
        if ($item->foto_path && Storage::disk('public')->exists($item->foto_path)) {
            Storage::disk('public')->delete($item->foto_path);
        }

        // 7.2. Hapus Record Item
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item berhasil dihapus!');
    }
}