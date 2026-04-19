<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi: Item belongs to Kategori (One-to-Many)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Relasi: Satu Item bisa memiliki banyak Klaim
    public function klaims()
    {
        return $this->hasMany(Klaim::class, 'item_id');
    }
}