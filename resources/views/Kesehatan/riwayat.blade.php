<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Riwayat Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-emerald-800">Riwayat Kesehatan</h1>
                <p class="text-gray-500 text-xs mt-0.5">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('kesehatan.create') }}" class="bg-emerald-800 hover:bg-emerald-900 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow-sm">
                    + Tambah Data
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl mb-4 text-xs">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-900 text-xs font-semibold uppercase border-b border-emerald-100">
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Tinggi</th>
                            <th class="p-3">Berat</th>
                            <th class="p-3">IMT</th>
                            <th class="p-3">Status Gizi</th>
                            <th class="p-3">Rekomendasi Ahli Gizi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                        @forelse($riwayatData as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 font-medium">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                                <td class="p-3">{{ $item->tinggi_badan }} cm</td>
                                <td class="p-3">{{ $item->berat_badan }} kg</td>
                                <td class="p-3 font-bold text-emerald-800">{{ $item->imt }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold
                                        {{ $item->status_gizi == 'Normal' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $item->status_gizi }}
                                    </span>
                                </td>
                                <td class="p-3 text-xs max-w-xs">
                                    @if($item->catatan_gizi)
                                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-2.5 space-y-1">
                                            <p class="font-semibold text-emerald-900">💬 Catatan Gizi:</p>
                                            <p class="text-gray-700">{{ $item->catatan_gizi }}</p>
                                            <p class="font-semibold text-emerald-900 mt-2">🥗 Rekomendasi Menu:</p>
                                            <p class="text-gray-700">{{ $item->rekomendasi_menu }}</p>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Menunggu evaluasi Ahli Gizi...</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-400">Belum ada data riwayat kesehatan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
