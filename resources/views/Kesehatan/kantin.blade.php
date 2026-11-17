<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Katalog Menu Kantin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6 min-h-screen">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Navigation Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-emerald-800">Katalog Menu Kantin Campus</h1>
                <p class="text-gray-500 text-xs mt-0.5">Pilih menu sehat sesuai rekomendasi Ahli Gizi & kebutuhan kalorimu</p>
            </div>

            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('kesehatan.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                    ← Riwayat Saya
                </a>

                

                <a href="{{ route('kesehatan.create') }}" class="bg-emerald-800 hover:bg-emerald-900 text-white px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                    + Input Data
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3.5 py-2 rounded-xl text-xs font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between gap-2 overflow-x-auto">
            <span class="text-xs font-bold text-gray-700 uppercase tracking-wider pl-2">Filter:</span>
            <div class="flex gap-2">
                <a href="{{ route('kesehatan.kantin') }}"
                   class="px-4 py-1.5 rounded-xl text-xs font-semibold border transition {{ !request('kategori') ? 'bg-emerald-800 text-white border-emerald-800' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                    Semua
                </a>
                <a href="{{ route('kesehatan.kantin', ['kategori' => 'makanan']) }}"
                   class="px-4 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('kategori') == 'makanan' ? 'bg-emerald-800 text-white border-emerald-800' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                    Makanan
                </a>
                <a href="{{ route('kesehatan.kantin', ['kategori' => 'minuman']) }}"
                   class="px-4 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('kategori') == 'minuman' ? 'bg-emerald-800 text-white border-emerald-800' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                    Minuman
                </a>
                <a href="{{ route('kesehatan.kantin', ['kategori' => 'camilan']) }}"
                   class="px-4 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('kategori') == 'camilan' ? 'bg-emerald-800 text-white border-emerald-800' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                    Camilan
                </a>
            </div>
        </div>

        <!-- Grid Menu Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($menus as $menu)
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                {{ $menu->kategori == 'makanan' ? 'bg-blue-100 text-blue-700' : ($menu->kategori == 'minuman' ? 'bg-amber-100 text-amber-700' : 'bg-purple-100 text-purple-700') }}">
                                {{ $menu->kategori }}
                            </span>
                            <span class="text-xs font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-100">
                                🔥 {{ $menu->kalori }} kKal
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-gray-800 mt-1">{{ $menu->nama_menu }}</h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $menu->deskripsi ?? 'Tidak ada deskripsi komposisi.' }}</p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-medium">Harga</span>
                        <span class="text-sm font-extrabold text-gray-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-12 rounded-2xl text-center border border-gray-100">
                    <p class="text-sm text-gray-400 font-medium">Belum ada menu kantin yang sesuai dengan kategori ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</body>
</html>
