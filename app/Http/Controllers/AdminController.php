<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MenuKantin;
use App\Models\DataKesehatan;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Data Ringkasan Statistik
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();$totalGizi      = User::where('role', 'ahli_gizi')->count();
        $totalMenu      = MenuKantin::count();$totalKesehatan = DataKesehatan::count();

        // 2. Data Pengguna / Log Audit Terbaru
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // 3. Data Menu Kantin
        $menus = MenuKantin::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalGizi',
            'totalMenu',
            'totalKesehatan',
            'recentUsers',
            'menus'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:makanan,minuman,camilan',
            'kalori'    => 'required|numeric',
            'harga'     => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        MenuKantin::create($request->all());

        return back()->with('success', 'Menu kantin berhasil ditambahkan!');
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'kategori'  => 'required|in:makanan,minuman,camilan',
            'kalori'    => 'required|numeric',
            'harga'     => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = MenuKantin::findOrFail($id);
        $menu->update($request->all());

        return back()->with('success', 'Menu kantin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = MenuKantin::findOrFail($id);$menu->delete();

        return back()->with('success', 'Menu kantin berhasil dihapus!');
    }
}
