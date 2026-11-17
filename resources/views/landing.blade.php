<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Personal Health & Nutrition Ecosystem</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased selection:bg-brand-500 selection:text-white min-h-screen flex flex-col justify-between">

    <!-- Top Navigation -->
    <header class="w-full max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-tr from-brand-800 to-brand-600 rounded-2xl flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-brand-700/20">
                N
            </div>
            <div>
                <span class="text-base font-extrabold tracking-tight text-slate-900 block leading-none">NUTRICARE</span>
                <span class="text-[10px] font-semibold text-brand-600 tracking-wider uppercase">Campus Health System</span>
            </div>
        </div>

        <a href="{{ route('pilihrole') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 hover:border-brand-500 text-slate-700 hover:text-brand-700 font-semibold text-xs rounded-xl shadow-sm transition-all duration-200 hover:shadow-md">
            <span>Masuk Akun</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
    </header>

    <!-- Main Hero Section -->
    <main class="w-full max-w-5xl mx-auto px-6 py-12 my-auto">
        <div class="bg-gradient-to-b from-white to-brand-50/40 rounded-3xl border border-slate-200/80 p-8 sm:p-14 text-center shadow-xl shadow-slate-200/50 relative overflow-hidden backdrop-blur-sm">

            <!-- Glow Accent Blur -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Hero Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-brand-100/70 border border-brand-200 text-brand-800 rounded-full text-xs font-semibold mb-6 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
                Platform Monitoring Kesehatan Kampus
            </div>

            <!-- Heading -->
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight max-w-3xl mx-auto">
                Pantau Kesehatan & Rekomendasi Gizi Personal Mahasiswa
            </h1>

            <p class="text-sm sm:text-base text-slate-600 font-normal max-w-2xl mx-auto mt-4 leading-relaxed">
                Kelola Indeks Massa Tubuh (IMT), dapatkan masukan menu harian dari Ahli Gizi terlisensi, dan pantau nutrisi menu kantin kampus secara real-time.
            </p>

            <!-- Call To Action -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('pilihrole') }}"
                   class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-brand-800 to-brand-700 hover:from-brand-900 hover:to-brand-800 text-white font-bold text-xs tracking-wide uppercase rounded-xl shadow-lg shadow-brand-800/25 transition-all duration-200 hover:-translate-y-0.5">
                    Mulai Sekarang
                </a>
            </div>

            <!-- Highlights Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-12 pt-10 border-t border-slate-200/60 text-left">
                <div class="p-4 rounded-2xl bg-white/80 border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm mb-2">📊</div>
                    <h4 class="text-xs font-bold text-slate-800">Grafik Interaktif</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Visualisasi tren berat badan dan IMT otomatis.</p>
                </div>
                <div class="p-4 rounded-2xl bg-white/80 border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm mb-2">🥗</div>
                    <h4 class="text-xs font-bold text-slate-800">Rekomendasi Ahli Gizi</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Catatan & saran menu makanan langsung dari pakar.</p>
                </div>
                <div class="p-4 rounded-2xl bg-white/80 border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 rounded-lg bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-sm mb-2">🏪</div>
                    <h4 class="text-xs font-bold text-slate-800">Katalog Kantin Campus</h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Informasi kalori dan harga setiap porsi menu kantin.</p>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full max-w-6xl mx-auto px-6 py-6 text-center border-t border-slate-200/50">
        <p class="text-xs text-slate-400 font-medium">© 2026 NutriCare Ecosystem. Designed for Campus Wellness.</p>
    </footer>

</body>
</html>
