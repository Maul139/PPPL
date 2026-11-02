<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NutriCareSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data User / Akun
        $userId = DB::table('users')->insertGetId([
            'name' => 'Akhtar Maulana',
            'email' => 'akhtar@student.its.ac.id',
            'password' => Hash::make('password123'),
            'peran' => 'Mahasiswa',
            'status_akun' => 'Aktif',
            'status_verifikasi' => 'Terverifikasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Data Kesehatan Mahasiswa
        DB::table('data_kesehatans')->insert([
            'user_id' => $userId,
            'tinggi_badan' => 170.5,
            'berat_badan' => 65.0,
            'alergi' => 'Udang',
            'gaya_hidup' => 'Sedang (Olahraga 2x seminggu)',
            'preferensi_makanan' => 'Rendah Gula',
            'anggaran_makan' => 30000,
            'tanggal_input' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Pengaturan Notifikasi
        DB::table('pengaturan_notifikasis')->insert([
            ['user_id' => $userId, 'jenis_pengingat' => 'Pengingat Makan Siang', 'waktu' => '12:00:00', 'metode' => 'Pop-up', 'status' => 'Aktif'],
            ['user_id' => $userId, 'jenis_pengingat' => 'Pengingat Minum Air', 'waktu' => '15:00:00', 'metode' => 'Pop-up', 'status' => 'Aktif'],
        ]);

        // 4. Sample Menu Kantin
        DB::table('menu_kantins')->insert([
            ['nama_menu' => 'Nasi Ayam Bakar Dada', 'nilai_gizi' => '450 kcal, Protein 35g', 'harga' => 18000, 'status_verifikasi' => 'Terverifikasi', 'tanggal_verifikasi' => now()],
            ['nama_menu' => 'Gado-Gado Telur', 'nilai_gizi' => '320 kcal, Serat 12g', 'harga' => 14000, 'status_verifikasi' => 'Terverifikasi', 'tanggal_verifikasi' => now()],
        ]);
    }
}
