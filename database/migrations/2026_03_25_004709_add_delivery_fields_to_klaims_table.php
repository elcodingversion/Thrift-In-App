<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('klaims', function (Blueprint $table) {
            $table->text('alamat_pengiriman')->nullable()->after('status_klaim');
            $table->string('resi_pengiriman')->nullable()->after('alamat_pengiriman');
        });

        // Ubah ENUM status klaim dengan raw statement agar lebih aman
        DB::statement("ALTER TABLE klaims MODIFY COLUMN status_klaim ENUM('Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Konfirmasi'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klaims', function (Blueprint $table) {
            $table->dropColumn(['alamat_pengiriman', 'resi_pengiriman']);
        });

        // Kembalikan ke enum asal (mengabaikan data yang cacat saat di rollback)
        DB::statement("ALTER TABLE klaims MODIFY COLUMN status_klaim ENUM('Menunggu Konfirmasi', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Konfirmasi'");
    }
};
