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
    Schema::create('catatan_konsultasis', function (Blueprint $table) {
        $table->id(); // Primary Key standar 'id'
        $table->foreignId('konsultasi_id')->constrained('sesi_konsultasis')->onDelete('cascade');
        $table->text('isi_catatan');
        $table->date('tanggal');
        $table->text('rekomendasi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_konsultasis');
    }
};
