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
        Schema::table('data_kesehatans', function (Blueprint $table) {
            $table->text('catatan_gizi')->nullable()->after('riwayat_penyakit');
            $table->text('rekomendasi_menu')->nullable()->after('catatan_gizi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_kesehatans', function (Blueprint $table) {
            $table->dropColumn(['catatan_gizi', 'rekomendasi_menu']);
        });
    }
};
