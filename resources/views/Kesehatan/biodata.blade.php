<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Biodata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6 sm:p-8">

        <div class="flex items-center gap-2 mb-4">
            <div class="w-6 h-6 bg-emerald-700 rounded-md flex items-center justify-center text-white font-bold text-xs">N</div>
            <span class="text-xs font-bold tracking-wider text-emerald-900">NUTRICARE</span>
        </div>

        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gray-300 rounded-full mx-auto mb-2 overflow-hidden flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <h2 class="font-bold text-gray-800 text-sm tracking-wider uppercase">BIODATA</h2>
        </div>

        <form action="{{ route('biodata.store') }}" method="POST" class="space-y-3">
            @csrf

            <input type="text" name="nama_lengkap" value="{{ Auth::user()->name ?? '' }}" placeholder="Nama Lengkap" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none" required>

            <input type="text" name="ttl" placeholder="Tempat Tanggal Lahir" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none">

            <input type="number" name="umur" placeholder="Umur" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none">

            <div class="relative">
                <input type="number" step="0.1" name="tinggi_badan" placeholder="Tinggi Badan" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none" required>
                <span class="absolute right-4 top-2.5 text-xs text-gray-500 font-semibold">Cm</span>
            </div>

            <div class="relative">
                <input type="number" step="0.1" name="berat_badan" placeholder="Berat Badan" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none" required>
                <span class="absolute right-4 top-2.5 text-xs text-gray-500 font-semibold">Kg</span>
            </div>

            <input type="text" name="alergi" placeholder="Alergi" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none">

            <input type="text" name="riwayat_penyakit" placeholder="Riwayat Penyakit" class="w-full bg-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-xs focus:outline-none">

            <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-semibold py-3 rounded-xl text-xs transition shadow-md mt-4">
                Simpan & Lanjutkan
            </button>
        </form>

    </div>
</body>
</html>
