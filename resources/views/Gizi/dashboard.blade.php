<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Dashboard Ahli Gizi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6 min-h-screen" x-data="{ openModal: false, selectedId: null, selectedName: '' }">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm mb-6 border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-emerald-800">Dashboard Ahli Gizi</h1>
                <p class="text-gray-500 text-xs mt-0.5">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow-sm">
                    Logout
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl mb-4 text-xs">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-base font-bold text-gray-800 mb-4">Daftar Rekam Kesehatan Mahasiswa</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-900 text-xs font-semibold uppercase border-b border-emerald-100">
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Mahasiswa</th>
                            <th class="p-3">Fisik</th>
                            <th class="p-3">IMT / Status</th>
                            <th class="p-3">Alergi & Penyakit</th>
                            <th class="p-3 text-center">Status Rekomendasi</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                        @forelse($riwayatMahasiswa as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 font-medium">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                                <td class="p-3 font-semibold text-emerald-800">{{ $item->user->name ?? 'Mahasiswa #'.$item->user_id }}</td>
                                <td class="p-3">{{ $item->tinggi_badan }} cm / {{ $item->berat_badan }} kg</td>
                                <td class="p-3">
                                    <span class="font-bold">{{ $item->imt }}</span>
                                    <span class="ml-1 px-2 py-0.5 rounded-full text-[10px] font-semibold
                                        {{ $item->status_gizi == 'Normal' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $item->status_gizi }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <p><span class="font-semibold">Alergi:</span> {{ $item->alergi ?? '-' }}</p>
                                    <p><span class="font-semibold">Penyakit:</span> {{ $item->riwayat_penyakit ?? '-' }}</p>
                                </td>
                                <td class="p-3 text-center">
                                    @if($item->catatan_gizi)
                                        <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full font-medium text-[10px]">Sudah Diberi</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full font-medium text-[10px]">Belum</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    <button @click="openModal = true; selectedId = {{ $item->id }}; selectedName = '{{ $item->user->name ?? 'Mahasiswa' }}'"
                                            class="bg-emerald-800 hover:bg-emerald-900 text-white px-3 py-1.5 rounded-lg font-medium text-[11px] transition shadow-sm">
                                        {{ $item->catatan_gizi ? 'Edit Rekomendasi' : '+ Beri Rekomendasi' }}
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

        <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center p-4 z-50" x-cloak>
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl" @click.outside="openModal = false">
                <h3 class="text-base font-bold text-emerald-900 mb-1">Input Rekomendasi Gizi</h3>
                <p class="text-xs text-gray-500 mb-4">Untuk: <span class="font-semibold text-gray-800" x-text="selectedName"></span></p>

                <form :action="'/gizi/rekomendasi/' + selectedId" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Catatan Evaluasi Gizi</label>
                        <textarea name="catatan_gizi" rows="3" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: Asupan kalori harian perlu ditingkatkan..." required></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Rekomendasi Menu Makanan</label>
                        <textarea name="rekomendasi_menu" rows="3" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: Nasi Merah, Ayam Bakar Tanpa Kulit, Sayur Bayam..." required></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-800 text-white rounded-xl text-xs font-semibold hover:bg-emerald-900 transition">Simpan Rekomendasi</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
