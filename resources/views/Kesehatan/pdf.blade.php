<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekam Kesehatan - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-gray-100 p-8 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <!-- Action Bar (Sembunyi saat dicetak/PDF) -->
        <div class="no-print flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
            <a href="{{ route('kesehatan.index') }}" class="text-xs font-semibold text-gray-600 hover:underline">
                ← Kembali ke Riwayat
            </a>
            <button onclick="window.print()" class="bg-emerald-800 hover:bg-emerald-900 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-sm transition">
                🖨️ Cetak / Save to PDF
            </button>
        </div>

        <!-- Kop Surat / Header Laporan -->
        <div class="flex justify-between items-center pb-6 border-b-2 border-emerald-800 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-emerald-900 tracking-wide">NUTRICARE SYSTEM</h1>
                <p class="text-xs text-gray-500 font-medium">Laporan Pemantauan Kesehatan & Evaluasi Gizi Mahasiswa</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 font-semibold">Tanggal Cetak:</p>
                <p class="text-xs font-bold text-gray-700">{{ now()->format('d F Y') }}</p>
            </div>
        </div>

        <!-- Biodata Mahasiswa -->
        <div class="bg-emerald-50/50 p-4 rounded-xl mb-6 border border-emerald-100 text-xs">
            <h2 class="font-bold text-emerald-900 uppercase tracking-wider mb-2">Informasi Mahasiswa</h2>
            <div class="grid grid-cols-2 gap-2 text-gray-700">
                <p><span class="font-semibold">Nama Lengkap:</span> {{ $user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
            </div>
        </div>

        <!-- Tabel Riwayat Data -->
        <h2 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-3">Catatan Rekam Kesehatan</h2>
        <table class="w-full text-left border-collapse text-xs mb-8">
            <thead>
                <tr class="bg-gray-100 text-gray-800 font-semibold border-b border-gray-300">
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Tinggi</th>
                    <th class="p-2 border">Berat</th>
                    <th class="p-2 border">IMT</th>
                    <th class="p-2 border">Status Gizi</th>
                    <th class="p-2 border">Evaluasi & Rekomendasi Ahli Gizi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatData as $index => $item)
                    <tr class="border-b border-gray-200">
                        <td class="p-2 border text-center">{{ $index + 1 }}</td>
                        <td class="p-2 border font-medium">{{ \Carbon\Carbon::parse($item->tanggal_input)->format('d M Y') }}</td>
                        <td class="p-2 border">{{ $item->tinggi_badan }} cm</td>
                        <td class="p-2 border">{{ $item->berat_badan }} kg</td>
                        <td class="p-2 border font-bold">{{ $item->imt }}</td>
                        <td class="p-2 border">{{ $item->status_gizi }}</td>
                        <td class="p-2 border">
                            @if($item->catatan_gizi)
                                <p class="font-semibold text-emerald-900">Catatan:</p>
                                <p class="mb-1 text-gray-700">{{ $item->catatan_gizi }}</p>
                                <p class="font-semibold text-emerald-900">Rekomendasi Menu:</p>
                                <p class="text-gray-700">{{ $item->rekomendasi_menu }}</p>
                            @else
                                <span class="text-gray-400 italic">Belum dievaluasi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 border text-center text-gray-400">Belum ada rekam kesehatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Signature Space -->
        <div class="flex justify-end pt-8">
            <div class="text-center text-xs text-gray-600">
                <p>Surabaya, {{ now()->format('d F Y') }}</p>
                <p class="font-semibold mt-1">Tim Ahli Gizi NutriCare</p>
                <div class="h-16"></div>
                <p class="font-bold underline text-gray-900">( Dr. Nutrisi, S.Gz )</p>
            </div>
        </div>

    </div>
</body>
</html>
