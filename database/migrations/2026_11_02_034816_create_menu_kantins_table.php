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
        Schema::create('menu_kantins', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->string('nilai_gizi');
            $table->double('harga');
            $table->string('status_verifikasi')->default('Pending');
            $table->date('tanggal_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_kantins');
    }
};
