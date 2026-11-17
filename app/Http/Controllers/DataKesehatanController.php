<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKesehatan;
use Illuminate\Support\Facades\Auth;

class DataKesehatanController extends Controller
{
    // Method untuk melihat Katalog Kantin
    public function kantin(Request $request)
    {
        $query = \App\Models\MenuKantin::query();

        // Filter Kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $menus = $query->orderBy('nama_menu', 'asc')->get();

        return view('kesehatan.kantin', compact('menus'));
    }

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

        $chartData = DataKesehatan::where('user_id', Auth::id())
        ->orderBy('tanggal_input', 'asc')
        ->get();

        $chartDates = $chartData->pluck('tanggal_input')->map(function($date) {
        return \Carbon\Carbon::parse($date)->format('d M Y');
        });

        $chartWeights = $chartData->pluck('berat_badan');
        $chartImts    = $chartData->map(function($item) {
        return $item->imt;
        });


        return view('kesehatan.riwayat', compact('riwayatData', 'chartDates', 'chartWeights', 'chartImts'));
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

    public function exportPdf()
    {
    $user = Auth::user();
    $riwayatData = DataKesehatan::where('user_id', $user->id)
        ->orderBy('tanggal_input', 'desc')
        ->get();

    return view('kesehatan.pdf', compact('user', 'riwayatData'));
    }
}
