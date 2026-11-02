<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKesehatan;
use Illuminate\Support\Facades\Auth;

class DataKesehatanController extends Controller
{
    // Menampilkan form input
    public function create()
    {
        return view('kesehatan.input');
    }

    // Menyimpan data dari form ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tinggi_badan' => 'required|numeric',
            'berat_badan'  => 'required|numeric',
            'alergi'       => 'nullable|string',
            'gaya_hidup'   => 'nullable|string',
            'preferensi_makanan' => 'nullable|string',
            'anggaran_makan'    => 'nullable|numeric',
        ]);

        DataKesehatan::create([
            'user_id'            => Auth::id() ?? 1,
            'tinggi_badan'       => $validated['tinggi_badan'],
            'berat_badan'        => $validated['berat_badan'],
            'alergi'             => $validated['alergi'] ?? null,
            'gaya_hidup'         => $validated['gaya_hidup'] ?? null,
            'preferensi_makanan' => $validated['preferensi_makanan'] ?? null,
            'anggaran_makan'    => $validated['anggaran_makan'] ?? null,
            'tanggal_input'      => now()->toDateString(),
        ]);

        return redirect()->route('kesehatan.index')->with('success', 'Data kesehatan berhasil disimpan!');
    }

    // Menampilkan daftar riwayat kesehatan
    public function index()
    {
        $riwayatData = DataKesehatan::where('user_id', Auth::id() ?? 1)
            ->orderBy('tanggal_input', 'desc')
            ->get();

        return view('kesehatan.riwayat', compact('riwayatData'));
    }
}
