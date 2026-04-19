<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            
            // FOREIGN KEY 1: Relasi ke tabel 'kategoris'
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            
            $table->string('nama_item');
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('harga');
            $table->string('ukuran'); // Contoh: S, M, L, Oversize
            $table->string('foto_path')->nullable(); // Untuk menyimpan path gambar
            
            // Kolom Status (Kritis untuk workflow)
            $table->enum('status', ['Tersedia', 'Diproses', 'Terjual'])->default('Tersedia');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};