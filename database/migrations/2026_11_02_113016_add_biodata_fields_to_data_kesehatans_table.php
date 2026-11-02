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
            $table->string('ttl')->nullable()->after('user_id');
            $table->integer('umur')->nullable()->after('ttl');
            $table->string('riwayat_penyakit')->nullable()->after('alergi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_kesehatans', function (Blueprint $table) {
            $table->dropColumn(['ttl', 'umur', 'riwayat_penyakit']);
        });
    }
};
