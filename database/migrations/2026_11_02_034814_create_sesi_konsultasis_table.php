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
    Schema::create('sesi_konsultasis', function (Blueprint $table) {
        $table->id(); // Primary Key standar 'id'
        $table->foreignId('jadwal_id')->constrained('jadwal_konsultasis')->onDelete('cascade');
        $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
        $table->date('tanggal');
        $table->time('jadwal');
        $table->string('media')->default('Online');
        $table->string('status')->default('Terjadwal');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_konsultasis');
    }
};
