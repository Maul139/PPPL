<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Riwayat Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 min-h-screen">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-emerald-600">Riwayat Kesehatan</h1>
        <p class="text-gray-500 text-sm">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('kesehatan.create') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-emerald-600 transition">
            + Tambah Data
        </a>

        <!-- Form Logout Mahasiswa -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                Logout
            </button>
        </form>
    </div>
</div>

        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif


        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-emerald-50 border-b border-emerald-100 text-emerald-800 text-xs uppercase font-semibold">
                        <th class="p-3">Tanggal Input</th>
                        <th class="p-3">Tinggi (cm)</th>
                        <th class="p-3">Berat (kg)</th>
                        <th class="p-3">Nilai IMT</th>
                        <th class="p-3">Status Gizi</th>
                        <th class="p-3">Alergi</th>
                        <th class="p-3">Gaya Hidup</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($riwayatData as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 font-medium">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                            <td class="p-3">{{ $item->tinggi_badan }} cm</td>
                            <td class="p-3">{{ $item->berat_badan }} kg</td>
                            <td class="p-3 font-bold">{{ $item->imt }}</td>
                            <td class="p-3">
                                @if($item->status_gizi == 'Normal')
                                    <span class="bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full text-xs font-semibold">Normal</span>
                                @elseif($item->status_gizi == 'Kurus')
                                    <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">Kurus</span>
                                @elseif($item->status_gizi == 'Gemuk')
                                    <span class="bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full text-xs font-semibold">Gemuk</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Obesitas</span>
                                @endif
                            </td>
                            <td class="p-3">{{ $item->alergi ?? '-' }}</td>
                            <td class="p-3">{{ $item->gaya_hidup ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-gray-400">Belum ada data kesehatan yang diinputkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
