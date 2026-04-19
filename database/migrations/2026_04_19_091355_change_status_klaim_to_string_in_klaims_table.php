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
        Schema::table('klaims', function (Blueprint $table) {
            $table->string('status_klaim')->default('Menunggu Konfirmasi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klaims', function (Blueprint $table) {
            // Revert to one of the enum values if needed, but it's simpler to just leave it as string or revert to the exact enum.
            // Since enum to string is safe, string to enum might lose data if there are non-matching values.
            $table->enum('status_klaim', ['Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'])->default('Menunggu Konfirmasi')->change();
        });
    }
};
