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
        <h1 class="text-2xl font-bold text-emerald-600 mb-2">NutriCare System</h1>
        <p class="text-gray-600 text-sm mb-6">Formulir Input Data Kesehatan Mahasiswa</p>
        <div class="space-y-3 text-left mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tinggi Badan (cm)</label>
                <input type="number" class="w-full border rounded-lg p-2 text-sm" placeholder="170">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Berat Badan (kg)</label>
                <input type="number" class="w-full border rounded-lg p-2 text-sm" placeholder="65">
            </div>
        </div>
        <button class="bg-emerald-500 text-white w-full py-2 rounded-lg font-medium hover:bg-emerald-600 transition">
            Simpan Data
        </button>
    </div>
</body>
</html>
