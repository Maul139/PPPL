<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKesehatan;

class GiziController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data kesehatan mahasiswa
        $riwayatMahasiswa = DataKesehatan::orderBy('tanggal_input', 'desc')->get();

        return view('gizi.dashboard', compact('riwayatMahasiswa'));
    }
}
