<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Menampilkan semua Kategori (dengan Pencarian dan Paginasi).
     */
    public function index(Request $request)
    {
        $query = Kategori::query();
        
        // Eager load hitungan item untuk efisiensi
        $query->withCount('items');
        
        // --- LOGIKA PENCARIAN DITINGKATKAN ---
        if ($request->filled('search')) {
            $search = $request->search;
            
            // Mencari kategori berdasarkan nama ATAU deskripsi
            $query->where(function ($q) use ($search) {
                // Catatan: Pastikan 'nama_kategori' dan 'description' adalah nama kolom yang benar
                $q->where('nama_kategori', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        // Paginate hasilnya dan tambahkan parameter query string
        $categories = $query->paginate(10)->withQueryString(); 

        // PERBAIKAN KRITIS: Mengembalikan view ke folder 'kategoris'
        return view('admin.kategoris.index', compact('categories'));
    }

    /**
     * Menampilkan Form untuk membuat Kategori baru.
     */
    public function create()
    {
        // PERBAIKAN KRITIS: Mengembalikan view ke folder 'kategoris'
        return view('admin.kategoris.create');
    }

    /**
     * Menyimpan data Kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Memastikan kolom yang divalidasi adalah 'nama_kategori' di DB
            'name' => 'required|unique:kategoris,nama_kategori|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        
        Kategori::create([
            'nama_kategori' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        // PERBAIKAN KRITIS: Redirect ke nama route 'admin.kategoris.index'
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail Kategori (Opsional)
     */
    public function show(Kategori $kategori)
    {
        $category = $kategori;
        // PERBAIKAN KRITIS: Mengembalikan view ke folder 'kategoris'
        return view('admin.kategoris.show', compact('category'));
    }

    /**
     * Menampilkan Form untuk mengedit Kategori.
     */
    public function edit(Kategori $kategori)
    {
        $category = $kategori;
        // PERBAIKAN KRITIS: Mengembalikan view ke folder 'kategoris'
        return view('admin.kategoris.edit', compact('category'));
    }

    /**
     * Memperbarui data Kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'name' => [
                'required', 
                'max:255',
                // Rule unik yang mengabaikan ID kategori yang sedang diedit
                Rule::unique('kategoris', 'nama_kategori')->ignore($kategori->id),
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        $kategori->update([
            'nama_kategori' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        // PERBAIKAN KRITIS: Redirect ke nama route 'admin.kategoris.index'
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus Kategori.
     */
    public function destroy(Kategori $kategori)
    {
        // Pengecekan untuk mencegah penghapusan jika ada item terkait
        if ($kategori->items()->exists()) {
            // PERBAIKAN KRITIS: Redirect ke nama route 'admin.kategoris.index'
            return redirect()->route('admin.kategoris.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki Item terkait.');
        }

        $kategori->delete();
        // PERBAIKAN KRITIS: Redirect ke nama route 'admin.kategoris.index'
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus!');
    }
}