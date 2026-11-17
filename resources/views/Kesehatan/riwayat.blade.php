<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Dashboard Mahasiswa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased p-4 sm:p-8 min-h-screen">
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Top Bar Header -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brand-800 to-brand-600 text-white flex items-center justify-center font-bold text-lg shadow-md shadow-brand-700/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-xl font-extrabold text-slate-900">Dashboard Kesehatan</h1>
                    <p class="text-xs text-slate-500 font-medium">Selamat datang kembali, <span class="text-brand-700 font-bold">{{ Auth::user()->name }}</span>!</p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('kesehatan.pdf') }}" target="_blank"
                   class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm">
                    📄 Cetak PDF
                </a>

                <a href="{{ route('kesehatan.kantin') }}"
                   class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm">
                    🥗 Kantin Campus
                </a>

                <a href="{{ route('kesehatan.create') }}"
                   class="inline-flex items-center gap-1.5 bg-gradient-to-r from-brand-800 to-brand-700 hover:from-brand-900 hover:to-brand-800 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-md shadow-brand-800/20">
                    + Input Data
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 px-4 py-2.5 rounded-xl text-xs font-bold transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-medium flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Quick Summary Cards -->
        @if(count($riwayatData) > 0)
            @php $latest = $riwayatData->first(); @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Berat Badan Terakhir</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-extrabold text-slate-900">{{ $latest->berat_badan }}</span>
                        <span class="text-xs text-slate-500 font-semibold">kg</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tinggi Badan</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-extrabold text-slate-900">{{ $latest->tinggi_badan }}</span>
                        <span class="text-xs text-slate-500 font-semibold">cm</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Indeks Massa Tubuh</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-extrabold text-brand-700">{{ $latest->imt }}</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status Gizi</span>
                    <div class="mt-1">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                            {{ $latest->status_gizi == 'Normal' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                            {{ $latest->status_gizi }}
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Visualisasi Grafik Progress -->
        @if(count($chartDates) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Grafik Berat Badan -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
                            <span>📈</span> Tren Berat Badan
                        </h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Satuan (Kg)</span>
                    </div>
                    <div class="h-60">
                        <canvas id="weightChart"></canvas>
                    </div>
                </div>

                <!-- Grafik IMT -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
                            <span>📊</span> Indeks Massa Tubuh (IMT)
                        </h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase">Skala IMT</span>
                    </div>
                    <div class="h-60">
                        <canvas id="imtChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tabel Catatan Riwayat -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <h3 class="text-sm font-extrabold text-slate-900 mb-4">Catatan Riwayat Kesehatan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="p-3.5">Tanggal</th>
                            <th class="p-3.5">Tinggi</th>
                            <th class="p-3.5">Berat</th>
                            <th class="p-3.5">IMT</th>
                            <th class="p-3.5">Status</th>
                            <th class="p-3.5">Evaluasi Ahli Gizi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                        @forelse($riwayatData as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="p-3.5 font-semibold text-slate-900">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                                <td class="p-3.5">{{ $item->tinggi_badan }} cm</td>
                                <td class="p-3.5">{{ $item->berat_badan }} kg</td>
                                <td class="p-3.5 font-extrabold text-brand-700">{{ $item->imt }}</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold
                                        {{ $item->status_gizi == 'Normal' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $item->status_gizi }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-xs max-w-sm">
                                    @if($item->catatan_gizi)
                                        <div class="bg-brand-50/60 border border-brand-100 rounded-2xl p-3 space-y-1.5">
                                            <p class="font-bold text-brand-900 flex items-center gap-1">
                                                <span>💬</span> Catatan Gizi:
                                            </p>
                                            <p class="text-slate-700 leading-relaxed">{{ $item->catatan_gizi }}</p>
                                            <p class="font-bold text-brand-900 flex items-center gap-1 pt-1 border-t border-brand-100">
                                                <span>🥗</span> Menu Direkomendasikan:
                                            </p>
                                            <p class="text-slate-700 leading-relaxed">{{ $item->rekomendasi_menu }}</p>
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic">Menunggu evaluasi Ahli Gizi...</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">Belum ada riwayat kesehatan. Klik "+ Input Data" untuk memulai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Chart Configuration JS -->
    <script>
        const dates = @json($chartDates);
        const weights = @json($chartWeights);
        const imts = @json($chartImts);

        if (dates.length > 0) {
            // Chart 1: Berat Badan
            const ctxW = document.getElementById('weightChart').getContext('2d');
            const gradW = ctxW.createLinearGradient(0, 0, 0, 200);
            gradW.addColorStop(0, 'rgba(5, 150, 105, 0.2)');
            gradW.addColorStop(1, 'rgba(5, 150, 105, 0.0)');

            new Chart(ctxW, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Berat Badan',
                        data: weights,
                        borderColor: '#059669',
                        borderWidth: 2.5,
                        backgroundColor: gradW,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#047857',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: '#f1f5f9' }, beginAtZero: false }
                    }
                }
            });

            // Chart 2: IMT
            const ctxI = document.getElementById('imtChart').getContext('2d');
            const gradI = ctxI.createLinearGradient(0, 0, 0, 200);
            gradI.addColorStop(0, 'rgba(217, 119, 6, 0.2)');
            gradI.addColorStop(1, 'rgba(217, 119, 6, 0.0)');

            new Chart(ctxI, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'IMT',
                        data: imts,
                        borderColor: '#d97706',
                        borderWidth: 2.5,
                        backgroundColor: gradI,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#b45309',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: '#f1f5f9' }, beginAtZero: false }
                    }
                }
            });
        }
    </script>
</body>
</html>
