<x-app-layout>

    <div class="max-w-5xl mx-auto space-y-4">

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <!-- Filter Status + Tambah Pesanan -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3">

            <div class="flex flex-wrap items-center gap-2">

                <!-- Semua -->
                <a href="{{ route('pesanan.index') }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-medium
                   {{ !request('status')
                        ? 'bg-gray-900 text-white'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>

                <!-- Diproses -->
                <a href="{{ route('pesanan.index', ['status' => 'diproses']) }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-medium
                   {{ request('status') == 'diproses'
                        ? 'bg-amber-500 text-white'
                        : 'bg-amber-50 text-amber-700 hover:bg-amber-100' }}">
                    Diproses
                </a>

                <!-- Sedang Dicuci -->
                <a href="{{ route('pesanan.index', ['status' => 'dicuci']) }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-medium
                   {{ request('status') == 'dicuci'
                        ? 'bg-blue-500 text-white'
                        : 'bg-blue-50 text-blue-700 hover:bg-blue-100' }}">
                    Sedang Dicuci
                </a>

                <!-- Siap Diambil -->
                <a href="{{ route('pesanan.index', ['status' => 'siap_diambil']) }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-medium
                   {{ request('status') == 'siap_diambil'
                        ? 'bg-emerald-500 text-white'
                        : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                    Siap Diambil
                </a>

                <!-- Selesai -->
                <a href="{{ route('pesanan.index', ['status' => 'selesai']) }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-medium
                   {{ request('status') == 'selesai'
                        ? 'bg-gray-700 text-white'
                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Selesai
                </a>

                <!-- Tambah Pesanan -->
                <a href="{{ route('pesanan.create') }}"
                   class="ml-auto flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pesanan
                </a>

            </div>
        </div>

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

        <!-- ===== Versi TABEL (laptop/tablet ke atas) ===== -->
        <div class="hidden md:block bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            @if ($pesanans->isEmpty())

                <div class="p-10 text-center text-sm text-gray-400">
                    Belum ada pesanan. Klik "Tambah Pesanan" untuk mulai catat pesanan laundry.
                </div>

            @else

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-gray-500">
                            <th class="px-6 py-3.5 font-medium">Kamar</th>
                            <th class="px-6 py-3.5 font-medium">Jumlah Item</th>
                            <th class="px-6 py-3.5 font-medium">Total</th>
                            <th class="px-6 py-3.5 font-medium">Status</th>
                            <th class="px-6 py-3.5 font-medium">Tanggal</th>
                            <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach ($pesanans as $pesanan)

                            <tr>

                                <td class="px-6 py-3.5 text-gray-900 font-medium">
                                    Kamar {{ $pesanan->nomor_kamar }}

                                    @if ($pesanan->nama_tamu)
                                        <span class="block text-xs text-gray-400 font-normal">
                                            {{ $pesanan->nama_tamu }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-3.5 text-gray-600">
                                    {{ $pesanan->items_count }} item
                                </td>

                                <td class="px-6 py-3.5 text-gray-700">
                                    Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-3.5">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                        {{ $statusStyle[$pesanan->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $statusLabel[$pesanan->status] ?? ucfirst($pesanan->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-3.5 text-gray-500">
                                    {{ $pesanan->created_at->format('d M Y, H:i') }}
                                </td>

                                <td class="px-6 py-3.5 text-right">
                                    <a href="{{ route('pesanan.show', $pesanan) }}"
                                       class="text-blue-600 hover:text-blue-700 font-medium">
                                        Lihat
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>

                <div class="p-4 border-t border-gray-100">
                    {{ $pesanans->links() }}
                </div>

            @endif

        </div>

        <!-- ===== Versi KARTU (HP / layar kecil) ===== -->
        <div class="md:hidden space-y-3">

            @forelse ($pesanans as $pesanan)

                <a href="{{ route('pesanan.show', $pesanan) }}"
                   class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-4">

                    <div class="flex items-start justify-between gap-3 mb-2">

                        <div>
                            <p class="font-semibold text-gray-900 text-sm">
                                Kamar {{ $pesanan->nomor_kamar }}
                            </p>

                            @if ($pesanan->nama_tamu)
                                <p class="text-xs text-gray-400">
                                    {{ $pesanan->nama_tamu }}
                                </p>
                            @endif
                        </div>

                        <span class="shrink-0 px-2.5 py-1 text-xs font-medium rounded-full
                            {{ $statusStyle[$pesanan->status] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $statusLabel[$pesanan->status] ?? ucfirst($pesanan->status) }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 text-sm">

                        <span class="text-gray-500">
                            {{ $pesanan->items_count }} item ·
                            {{ $pesanan->created_at->format('d M, H:i') }}
                        </span>

                        <span class="font-bold text-gray-900">
                            Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                        </span>

                    </div>

                </a>

            @empty

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-sm text-gray-400">
                    Belum ada pesanan. Klik "Tambah Pesanan" untuk mulai catat pesanan laundry.
                </div>

            @endforelse

            <div class="pt-2">
                {{ $pesanans->links() }}
            </div>

        </div>

    </div>

</x-app-layout>