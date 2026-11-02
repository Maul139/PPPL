<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Dashboard Ahli Gizi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-6">
            <div>
                <h1 class="text-2xl font-bold text-emerald-600">Dashboard Ahli Gizi</h1>
                <p class="text-gray-500 text-xs">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-xs font-medium hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- Tabel Monitoring Kesehatan Mahasiswa -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Daftar Data Kesehatan Mahasiswa</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 border-b border-emerald-100 text-emerald-800 text-xs uppercase font-semibold">
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">User ID</th>
                            <th class="p-3">Tinggi / Berat</th>
                            <th class="p-3">Nilai IMT</th>
                            <th class="p-3">Status Gizi</th>
                            <th class="p-3">Alergi & Preferensi</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse($riwayatMahasiswa as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 text-xs font-medium">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                                <td class="p-3 font-semibold text-emerald-600">User #{{ $item->user_id }}</td>
                                <td class="p-3">{{ $item->tinggi_badan }} cm / {{ $item->berat_badan }} kg</td>
                                <td class="p-3 font-bold">{{ $item->imt }}</td>
                                <td class="p-3">
                                    @if($item->status_gizi == 'Normal')
                                        <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">Normal</span>
                                    @elseif($item->status_gizi == 'Kurus')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-semibold">Kurus</span>
                                    @elseif($item->status_gizi == 'Gemuk')
                                        <span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full text-xs font-semibold">Gemuk</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs font-semibold">Obesitas</span>
                                    @endif
                                </td>
                                <td class="p-3 text-xs">
                                    <p><span class="font-semibold">Alergi:</span> {{ $item->alergi ?? '-' }}</p>
                                    <p><span class="font-semibold">Gaya Hidup:</span> {{ $item->gaya_hidup ?? '-' }}</p>
                                </td>
                                <td class="p-3 text-center">
                                    <button class="bg-emerald-500 text-white px-3 py-1 rounded text-xs hover:bg-emerald-600 transition">
                                        Beri Rekomendasi
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-400">Belum ada data mahasiswa yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
