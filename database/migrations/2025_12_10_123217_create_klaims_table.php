<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klaims', function (Blueprint $table) {
            $table->id();
            
            // FOREIGN KEY 1: Relasi ke tabel 'users' (Siapa yang klaim)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // FOREIGN KEY 2: Relasi ke tabel 'items' (Item apa yang diklaim)
            // Pastikan Anda sudah punya tabel 'items' sebelum menjalankan migrasi ini.
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');

            // Status Klaim (Kritis untuk workflow admin)
            $table->enum('status_klaim', ['Menunggu Konfirmasi', 'Selesai', 'Dibatalkan'])->default('Menunggu Konfirmasi');
            
            $table->timestamp('tgl_klaim')->useCurrent();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klaims');
    }
};