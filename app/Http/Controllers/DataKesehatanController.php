<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKesehatan;
use Illuminate\Support\Facades\Auth;

class DataKesehatanController extends Controller
{
    public function create()
    {
        return view('kesehatan.input');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tinggi_badan'       => 'required|numeric',
            'berat_badan'        => 'required|numeric',
            'alergi'             => 'nullable|string',
            'gaya_hidup'         => 'nullable|string',
            'preferensi_makanan' => 'nullable|string',
            'anggaran_makan'    => 'nullable|numeric',
        ]);

        DataKesehatan::create([
            'user_id'            => Auth::id(),
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

    public function index()
    {
        $riwayatData = DataKesehatan::where('user_id', Auth::id())
            ->orderBy('tanggal_input', 'desc')
            ->get();

        return view('kesehatan.riwayat', compact('riwayatData'));
    }

    public function showBiodataForm()
    {
        return view('kesehatan.biodata');
    }

    public function storeBiodata(Request $request)
    {
        $validated = $request->validate([
            'ttl'              => 'nullable|string|max:255',
            'umur'             => 'nullable|numeric',
            'tinggi_badan'     => 'required|numeric',
            'berat_badan'      => 'required|numeric',
            'alergi'           => 'nullable|string|max:255',
            'riwayat_penyakit' => 'nullable|string|max:255',
        ]);

        DataKesehatan::create([
            'user_id'          => Auth::id(),
            'ttl'              => $validated['ttl'] ?? null,
            'umur'             => $validated['umur'] ?? null,
            'tinggi_badan'     => $validated['tinggi_badan'],
            'berat_badan'      => $validated['berat_badan'],
            'alergi'           => $validated['alergi'] ?? null,
            'riwayat_penyakit' => $validated['riwayat_penyakit'] ?? null,
            'tanggal_input'    => now()->toDateString(),
        ]);

        return redirect()->route('kesehatan.index')->with('success', 'Biodata awal berhasil disimpan!');
    }
}
