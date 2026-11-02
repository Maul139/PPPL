<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AdminController;




class AdminController extends Controller
{
    public function index()
    {
        // Contoh data ringkasan untuk dashboard admin
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalMahasiswa'));
    }
    
}
