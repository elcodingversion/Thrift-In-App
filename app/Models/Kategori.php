<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Tidak digunakan, bisa dihapus jika tidak ada fungsi Str di boot/scopes

class Kategori extends Model
{
    use HasFactory;
    
    /**
     * @var string Nama tabel di database. Didefinisikan eksplisit untuk kejelasan.
     */
    protected $table = 'kategoris';

    /**
     * @var array Kolom yang bisa diisi (mass assignment).
     */
    protected $fillable = [
        'nama_kategori',
        'description'
    ];

    /**
     * @var array Casting tipe data untuk atribut.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS & MUTATORS (Untuk memudahkan akses di View)
    |--------------------------------------------------------------------------
    */

    /**
     * Accessor: Mengakses nama_kategori sebagai 'name'. 
     * Ini digunakan di view: $category->name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->nama_kategori;
    }

    /**
     * Mutator: Set nama_kategori melalui properti 'name'.
     * Digunakan: $category->name = 'Kategori Baru'
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['nama_kategori'] = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi: Satu Kategori memiliki banyak Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        // Pastikan 'kategori_id' adalah foreign key di tabel Item
        return $this->hasMany(Item::class, 'kategori_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES (Query Builder Helpers)
    |--------------------------------------------------------------------------
    */

    /**
     * Scope: Filter berdasarkan nama kategori atau deskripsi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('nama_kategori', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        }
        
        return $query;
    }

    /**
     * Scope: Hanya kategori yang memiliki item.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasItems($query)
    {
        return $query->has('items');
    }

    /**
     * Scope: Hanya kategori yang tidak memiliki item.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutItems($query)
    {
        return $query->doesntHave('items');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS (Business Logic)
    |--------------------------------------------------------------------------
    */

    /**
     * Helper: Cek apakah kategori memiliki item (menggunakan exists()).
     *
     * @return bool
     */
    public function hasItems()
    {
        return $this->items()->exists();
    }

    /**
     * Helper/Attribute: Mendapatkan jumlah item terkait.
     * Lebih efisien jika dipanggil menggunakan withCount('items')
     *
     * @return int
     */
    public function getItemsCountAttribute()
    {
        // Menggunakan attribute items_count jika sudah di-eager loaded (withCount)
        if (isset($this->attributes['items_count'])) {
            return $this->attributes['items_count'];
        }
        
        // Default: hitung langsung jika belum di-load
        return $this->items()->count();
    }

    /*
    |--------------------------------------------------------------------------
    | BOOTING (Event Listeners)
    |--------------------------------------------------------------------------
    */

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        // Contoh event listener:
        // static::creating(function ($kategori) {
        //     $kategori->slug = Str::slug($kategori->nama_kategori);
        // });
    }
}