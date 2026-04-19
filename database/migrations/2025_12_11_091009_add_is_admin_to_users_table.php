<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'is_admin' bertipe boolean dengan nilai default FALSE (0)
            // Kolom ini akan digunakan untuk otorisasi (Gate 'admin')
            $table->boolean('is_admin')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'is_admin' jika migrasi di-rollback
            $table->dropColumn('is_admin');
        });
    }
};