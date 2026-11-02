<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Input Data Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-md max-w-md w-full text-center">
    <!-- Header Navigation -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <a href="{{ route('kesehatan.index') }}" class="text-xs text-emerald-600 font-semibold hover:underline">
            ← Kembali ke Riwayat
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-xs text-red-500 font-semibold hover:underline">
                Logout
            </button>
        </form>
    </div>

    <h1 class="text-2xl font-bold text-emerald-600 mb-2">NutriCare System</h1>
    <p class="text-gray-600 text-sm mb-6">Formulir Input Data Kesehatan Mahasiswa</p>

        <!-- Notifikasi Berhasil -->
        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form utama terhubung ke Route Laravel -->
        <form action="{{ route('kesehatan.store') }}" method="POST">
            @csrf

            <div class="space-y-3 text-left mb-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tinggi Badan (cm)</label>
                    <input type="number" step="0.1" name="tinggi_badan" class="w-full border rounded-lg p-2 text-sm" placeholder="170" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Berat Badan (kg)</label>
                    <input type="number" step="0.1" name="berat_badan" class="w-full border rounded-lg p-2 text-sm" placeholder="65" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Alergi (Opsional)</label>
                    <input type="text" name="alergi" class="w-full border rounded-lg p-2 text-sm" placeholder="Udang, Kacang, dll">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Gaya Hidup (Opsional)</label>
                    <input type="text" name="gaya_hidup" class="w-full border rounded-lg p-2 text-sm" placeholder="Sedang, Aktif, Jarang Olahraga">
                </div>
            </div>

            <button type="submit" class="bg-emerald-500 text-white w-full py-2 rounded-lg font-medium hover:bg-emerald-600 transition">
                Simpan Data
            </button>
        </form>
    </div>
</body>
</html>
