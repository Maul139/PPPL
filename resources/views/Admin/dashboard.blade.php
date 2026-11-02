<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-6">
            <div>
                <h1 class="text-2xl font-bold text-emerald-600">Dashboard Admin & Pengelola</h1>
                <p class="text-gray-500 text-xs">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-semibold uppercase">Total Pengguna Terdaftar</p>
                <h2 class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalUsers }}</h2>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-semibold uppercase">Total Mahasiswa</p>
                <h2 class="text-3xl font-bold text-blue-600 mt-1">{{ $totalMahasiswa }}</h2>
            </div>
        </div>

        <!-- Quick Access Menu Admin -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Fitur Pengelola Sistem</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="border rounded-lg p-4 hover:border-emerald-500 cursor-pointer transition">
                    <h3 class="font-bold text-sm text-emerald-700">Kelola Menu Kantin</h3>
                    <p class="text-xs text-gray-500 mt-1">Tambah & atur kandungan gizi menu makanan kantin.</p>
                </div>
                <div class="border rounded-lg p-4 hover:border-emerald-500 cursor-pointer transition">
                    <h3 class="font-bold text-sm text-emerald-700">Kelola User</h3>
                    <p class="text-xs text-gray-500 mt-1">Atur role mahasiswa, ahli gizi, dan admin.</p>
                </div>
                <div class="border rounded-lg p-4 hover:border-emerald-500 cursor-pointer transition">
                    <h3 class="font-bold text-sm text-emerald-700">Log Audit Sistem</h3>
                    <p class="text-xs text-gray-500 mt-1">Pantau riwayat aktivitas pengguna di sistem.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
