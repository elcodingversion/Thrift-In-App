<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi: Klaim belongs to Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    // Relasi: Klaim belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}