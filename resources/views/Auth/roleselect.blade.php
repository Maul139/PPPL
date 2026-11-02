<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Pilih Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-6 sm:p-8 text-center flex flex-col items-center justify-center min-h-[480px]">

        <div class="mb-6">
            <div class="w-20 h-20 bg-emerald-700 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-wider text-emerald-900">NUTRICARE</h1>
            <p class="text-xs text-gray-500 font-medium mt-2">Apakah kamu Mahasiswa atau Ahli gizi?</p>
        </div>

        <div class="w-full space-y-3 mt-4">
            <a href="{{ route('login.role', ['role' => 'mahasiswa']) }}"
               class="block w-full py-3 bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-xl text-sm transition shadow-md">
                Mahasiswa
            </a>
            <a href="{{ route('login.role', ['role' => 'ahli_gizi']) }}"
               class="block w-full py-3 bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-xl text-sm transition shadow-md">
                Ahli gizi
            </a>
        </div>

    </div>
</body>
</html>
