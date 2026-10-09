<x-app-layout>
    <div class="flex justify-end mb-4">
        <div id="jam-status"
            class="flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-medium">
            <span id="jam-dot" class="w-2 h-2 rounded-full"></span>
            <span id="jam-teks"></span>
        </div>
    </div>

    <script>
        function updateJamStatus() {
            const now = new Date();

            const jam = now.getHours();
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');

            const jamFormat =
                String(jam).padStart(2, '0') + ':' +
                menit + ':' +
                detik;

            const buka = jam >= 6 && jam < 21;

            const wrap = document.getElementById('jam-status');
            const dot = document.getElementById('jam-dot');
            const teks = document.getElementById('jam-teks');

            if (buka) {
                wrap.className =
                    'flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700';

                dot.className =
                    'w-2 h-2 rounded-full bg-emerald-500';

                teks.textContent =
                    'Buka · ' + jamFormat;
            } else {
                wrap.className =
                    'flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500';

                dot.className =
                    'w-2 h-2 rounded-full bg-gray-400';

                teks.textContent =
                    'Tutup · ' + jamFormat;
            }
        }

        updateJamStatus();
        setInterval(updateJamStatus, 1000);
    </script>

    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Card Ringkasan -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2h-3.28a1 1 0 01-.95-.68l-.44-1.32A1 1 0 0013.36 2h-2.72a1 1 0 00-.95.68l-.44 1.32a1 1 0 01-.95.68H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl sm:text-2xl font-extrabold text-gray-900">{{ $pesananHariIni }}</p>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Pesanan Hari Ini</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m0-2c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl sm:text-2xl font-extrabold text-gray-900">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Pendapatan Hari Ini</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl sm:text-2xl font-extrabold text-gray-900">{{ $sedangDicuci }}</p>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Sedang Dicuci</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <p class="text-xl sm:text-2xl font-extrabold text-gray-900">{{ $siapDiambil }}</p>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Siap Diambil</p>
            </div>
        </div>

        <!-- Pesanan terbaru -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-6">
            <h3 class="font-bold text-gray-900 mb-1">Pesanan Terbaru</h3>
            <p class="text-sm text-gray-500 mb-4">Daftar pesanan yang masuk hari ini.</p>

            @if($pesananTerbaru->isEmpty())
                <div class="border border-dashed border-gray-200 rounded-xl p-8 text-center text-sm text-gray-400">
                    Belum ada pesanan hari ini
                </div>
            @else
                @php
                    $statusStyle = [
                        'diproses' => 'bg-amber-100 text-amber-700',
                        'dicuci' => 'bg-blue-100 text-blue-700',
                        'siap_diambil' => 'bg-emerald-100 text-emerald-700',
                        'selesai' => 'bg-gray-100 text-gray-700',
                    ];
                    $statusLabel = [
                        'diproses' => 'Diproses',
                        'dicuci' => 'Sedang Dicuci',
                        'siap_diambil' => 'Siap Diambil',
                        'selesai' => 'Selesai',
                    ];
                @endphp

                <!-- Versi tabel: laptop ke atas -->
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nomor Kamar</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesananTerbaru as $pesanan)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $pesanan->nomor_kamar }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statusStyle[$pesanan->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $statusLabel[$pesanan->status] ?? ucfirst($pesanan->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Versi kartu: HP -->
                <div class="sm:hidden space-y-2">
                    @foreach($pesananTerbaru as $pesanan)
                        <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Kamar {{ $pesanan->nomor_kamar }}</p>
                                <p class="text-xs text-gray-500">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statusStyle[$pesanan->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ $statusLabel[$pesanan->status] ?? ucfirst($pesanan->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-app-layout>