<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // PENTING: Import HasMany

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_profil',
    ];

    // ... (protected $hidden dan protected function casts() tetap sama)

    // =========================================================
    // --- TAMBAHAN RELASI UNTUK THRIFT-IN APP ---
    // =========================================================

    /**
     * Get the claims made by the User.
     */
    public function klaims(): HasMany
    {
        // Menghubungkan User dengan banyak Klaim melalui 'user_id' di tabel klaims
        return $this->hasMany(Klaim::class, 'user_id');
    }
}