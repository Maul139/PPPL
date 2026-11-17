<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Pilih Role</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0fdf4', 100: '#dcfce7', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/60 p-8 text-center relative overflow-hidden">

        <!-- Glow Accent -->
        <div class="absolute -top-16 -right-16 w-40 h-40 bg-brand-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Logo Icon -->
        <div class="w-16 h-16 bg-gradient-to-tr from-brand-800 to-brand-600 rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-lg shadow-brand-700/25 mx-auto mb-5">
            N
        </div>

        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">NUTRICARE</h1>
        <p class="text-xs text-slate-500 font-medium mt-1.5 mb-8">Silakan pilih peran kamu untuk melanjutkan ke portal</p>

        <div class="space-y-3.5">
            <a href="{{ route('login.role', ['role' => 'mahasiswa']) }}"
               class="group flex items-center justify-between w-full p-4 bg-slate-50 hover:bg-brand-50 border border-slate-200/80 hover:border-brand-300 rounded-2xl text-left transition-all duration-200">
                <div>
                    <h3 class="text-xs font-extrabold text-slate-900 group-hover:text-brand-800">Aku Mahasiswa</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Pantau IMT, grafik kesehatan & kantin</p>
                </div>
                <span class="text-slate-400 group-hover:text-brand-700 text-sm transition-transform group-hover:translate-x-1">→</span>
            </a>

            <a href="{{ route('login.role', ['role' => 'ahli_gizi']) }}"
               class="group flex items-center justify-between w-full p-4 bg-slate-50 hover:bg-brand-50 border border-slate-200/80 hover:border-brand-300 rounded-2xl text-left transition-all duration-200">
                <div>
                    <h3 class="text-xs font-extrabold text-slate-900 group-hover:text-brand-800">Sebagai Ahli Gizi</h3>
                    <p class="text-[11px] text-slate-500 mt-0.5">Evaluasi & beri rekomendasi nutrisi</p>
                </div>
                <span class="text-slate-400 group-hover:text-brand-700 text-sm transition-transform group-hover:translate-x-1">→</span>
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100">
            <a href="{{ route('landing') }}" class="text-[11px] font-semibold text-slate-400 hover:text-slate-600">
                ← Kembali ke Landing Page
            </a>
        </div>

    </div>
</body>
</html>
