<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKesehatan;

class GiziController extends Controller
{
    public function index()
    {
        $riwayatMahasiswa = DataKesehatan::with('user')->orderBy('tanggal_input', 'desc')->get();

        return view('gizi.dashboard', compact('riwayatMahasiswa'));
    }

    public function storeRekomendasi(Request $request, $id)
    {
        $request->validate([
            'catatan_gizi'     => 'required|string',
            'rekomendasi_menu' => 'required|string',
        ]);

        $data = DataKesehatan::findOrFail($id);
        $data->update([
            'catatan_gizi'     => $request->catatan_gizi,
            'rekomendasi_menu' => $request->rekomendasi_menu,
        ]);

        return back()->with('success', 'Rekomendasi gizi berhasil dikirimkan ke mahasiswa!');
    }
}
