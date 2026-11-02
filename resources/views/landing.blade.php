<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Pemantauan & Rekomendasi Gizi Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between items-center p-4">

    <!-- Header Navigation -->
    <header class="w-full max-w-md flex justify-between items-center py-4">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-emerald-700 rounded-lg flex items-center justify-center text-white font-bold text-xs">N</div>
            <span class="text-sm font-bold tracking-wider text-emerald-900">NUTRICARE</span>
        </div>
        <a href="{{ route('pilihrole') }}" class="text-xs font-semibold text-emerald-700 hover:underline">
            Login
        </a>
    </header>

    <!-- Hero Card Container (Fluid: Mobile & Desktop Friendly) -->
    <main class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8 text-center flex flex-col items-center justify-center my-auto min-h-[460px]">

        <!-- Animated / Soft Icon -->
        <div class="w-24 h-24 bg-emerald-50 rounded-3xl flex items-center justify-center mb-6 shadow-sm border border-emerald-100">
            <div class="w-16 h-16 bg-emerald-700 rounded-2xl flex items-center justify-center text-white shadow-md">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/>
                </svg>
            </div>
        </div>

        <!-- Title & Subtitle -->
        <h1 class="text-2xl font-extrabold text-emerald-900 tracking-wide mb-2">NUTRICARE</h1>
        <p class="text-xs text-gray-500 font-medium px-4 leading-relaxed mb-8">
            Platform pemantauan kesehatan & rekomendasi gizi personal untuk gaya hidup mahasiswa yang lebih sehat.
        </p>

        <!-- Main Action Buttons -->
        <div class="w-full space-y-3">
            <a href="{{ route('pilihrole') }}"
               class="block w-full py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-2xl text-xs tracking-wider transition shadow-md">
                MULAI SEKARANG
            </a>
        </div>

    </main>

    <!-- Footer -->
    <footer class="w-full max-w-md text-center py-4">
        <p class="text-[10px] text-gray-400 font-medium">© 2026 NutriCare System. All rights reserved.</p>
    </footer>

</body>
</html>
