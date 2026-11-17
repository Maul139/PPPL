<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriCare - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6 min-h-screen"
      x-data="{
          openModal: false,
          isEdit: false,
          formUrl: '{{ route('admin.menu.store') }}',
          nama: '',
          kategori: 'makanan',
          kalori: '',
          harga: '',
          deskripsi: ''
      }">

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-emerald-800">Dashboard Admin NutriCare</h1>
                <p class="text-gray-500 text-xs mt-0.5">Sistem Manajemen & Log Audit</p>
            </div>

            <div class="flex items-center gap-2">
                <button @click="
                            isEdit = false;
                            formUrl = '{{ route('admin.menu.store') }}';
                            nama = ''; kategori = 'makanan'; kalori = ''; harga = ''; deskripsi = '';
                            openModal = true;"
                        class="bg-emerald-800 hover:bg-emerald-900 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow-sm">
                    + Tambah Menu Kantin
                </button>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-semibold transition shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl text-xs">
                {{ session('success') }}
            </div>
        @endif

        <!-- 1. Statistik Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-medium">Mahasiswa Terdaftar</p>
                <h3 class="text-2xl font-bold text-emerald-800 mt-1">{{ $totalMahasiswa }}</h3>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-medium">Ahli Gizi</p>
                <h3 class="text-2xl font-bold text-emerald-800 mt-1">{{ $totalGizi }}</h3>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-medium">Rekam Kesehatan</p>
                <h3 class="text-2xl font-bold text-emerald-800 mt-1">{{ $totalKesehatan }}</h3>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-xs text-gray-500 font-medium">Menu Kantin</p>
                <h3 class="text-2xl font-bold text-emerald-800 mt-1">{{ $totalMenu }}</h3>
            </div>
        </div>

        <!-- 2. Log Pengguna / Aktivitas Audit Terbaru -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-base font-bold text-gray-800 mb-4">Log Pengguna Terbaru</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-900 text-xs font-semibold uppercase border-b border-emerald-100">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Waktu Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                        @forelse($recentUsers as $u)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 font-semibold text-gray-800">{{ $u->name }}</td>
                                <td class="p-3">{{ $u->email }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold
                                        {{ $u->role == 'admin' ? 'bg-purple-100 text-purple-700' : ($u->role == 'ahli_gizi' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                        {{ ucfirst($u->role) }}
                                    </span>
                                </td>
                                <td class="p-3 text-gray-500">{{ $u->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400">Belum ada log pengguna.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Katalog Menu Kantin Campus -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-base font-bold text-gray-800 mb-4">Katalog Menu Kantin Campus</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-900 text-xs font-semibold uppercase border-b border-emerald-100">
                            <th class="p-3">Nama Menu</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Kalori (kKal)</th>
                            <th class="p-3">Harga (Rp)</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs text-gray-700">
                        @forelse($menus as $menu)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-3 font-semibold text-gray-800">{{ $menu->nama_menu }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold
                                        {{ $menu->kategori == 'makanan' ? 'bg-blue-100 text-blue-700' : ($menu->kategori == 'minuman' ? 'bg-amber-100 text-amber-700' : 'bg-purple-100 text-purple-700') }}">
                                        {{ ucfirst($menu->kategori) }}
                                    </span>
                                </td>
                                <td class="p-3 font-medium">{{ $menu->kalori }} kKal</td>
                                <td class="p-3 font-medium">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td class="p-3 text-gray-500 max-w-xs truncate">{{ $menu->deskripsi ?? '-' }}</td>
                                <td class="p-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button @click="
                                                    isEdit = true;
                                                    formUrl = '/admin/menu/update/{{ $menu->id }}';
                                                    nama = '{{ $menu->nama_menu }}';
                                                    kategori = '{{ $menu->kategori }}';
                                                    kalori = '{{ $menu->kalori }}';
                                                    harga = '{{ $menu->harga }}';
                                                    deskripsi = '{{ $menu->deskripsi }}';
                                                    openModal = true;"
                                                class="bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1 rounded-lg text-[10px] font-semibold transition">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2.5 py-1 rounded-lg text-[10px] font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-400">Belum ada menu kantin yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form (Tambah / Edit) -->
        <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center p-4 z-50" x-cloak>
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl" @click.outside="openModal = false">
                <h3 class="text-base font-bold text-emerald-900 mb-4" x-text="isEdit ? 'Edit Menu Kantin' : 'Tambah Menu Kantin Baru'"></h3>

                <form :action="formUrl" method="POST" class="space-y-3">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Menu</label>
                        <input type="text" name="nama_menu" x-model="nama" placeholder="Contoh: Nasi Bakar Ayam" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" x-model="kategori" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600">
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                            <option value="camilan">Camilan</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kalori (kKal)</label>
                            <input type="number" name="kalori" x-model="kalori" placeholder="450" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" x-model="harga" placeholder="15000" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Deskripsi / Komposisi</label>
                        <textarea name="deskripsi" x-model="deskripsi" rows="2" class="w-full bg-gray-100 rounded-xl p-3 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Keterangan singkat menu..."></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-800 text-white rounded-xl text-xs font-semibold hover:bg-emerald-900 transition" x-text="isEdit ? 'Simpan Perubahan' : 'Tambah Menu'"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
