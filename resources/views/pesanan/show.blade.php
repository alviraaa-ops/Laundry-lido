<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3">

            <div>
                <h2 class="font-extrabold text-2xl text-gray-900">
                    Kamar {{ $pesanan->nomor_kamar }}
                </h2>

                <p class="text-sm text-gray-500 mt-0.5">
                    @if ($pesanan->nama_tamu)
                        {{ $pesanan->nama_tamu }} &middot;
                    @endif
                    Dibuat {{ $pesanan->created_at->format('d M Y, H:i') }}
                </p>

                <div class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 border border-blue-100">
                    <span class="text-xs text-blue-600 font-medium">Kode Pesanan:</span>
                    <span class="text-sm font-bold text-blue-800 tracking-wider">{{ $pesanan->kode_pesanan ?? '-' }}</span>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Beritahu kode ini pada tamu untuk cek status pemesanan </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-4">

        @if (session('status'))
            <div class="rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <!-- Update status -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <p class="text-sm font-semibold text-gray-800 mb-3">
                Status Pesanan
            </p>

            <form method="POST"
                  action="{{ route('pesanan.updateStatus', $pesanan) }}"
                  class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2">

                @csrf
                @method('PATCH')

                @php
                    $options = [
                        'diproses' => [
                            'label' => 'Diproses',
                            'active' => 'bg-amber-500 text-white',
                            'idle' => 'bg-amber-50 text-amber-700 hover:bg-amber-100'
                        ],
                        'dicuci' => [
                            'label' => 'Sedang Dicuci',
                            'active' => 'bg-blue-500 text-white',
                            'idle' => 'bg-blue-50 text-blue-700 hover:bg-blue-100'
                        ],
                        'siap_diambil' => [
                            'label' => 'Siap Diambil',
                            'active' => 'bg-emerald-500 text-white',
                            'idle' => 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100'
                        ],
                        'selesai' => [
                            'label' => 'Selesai',
                            'active' => 'bg-gray-700 text-white',
                            'idle' => 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                        ],
                    ];
                @endphp

                @foreach ($options as $value => $opt)
                    <button
                        type="submit"
                        name="status"
                        value="{{ $value }}"
                        class="px-3.5 py-2 rounded-xl text-sm font-medium transition text-center
                        {{ $pesanan->status == $value ? $opt['active'] : $opt['idle'] }}">
                        {{ $opt['label'] }}
                    </button>
                @endforeach

            </form>
        </div>

        <!-- Detail item -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <!-- Versi tabel: laptop ke atas -->
            <table class="hidden sm:table w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-left text-gray-500">
                        <th class="px-6 py-3 font-medium">Item</th>
                        <th class="px-6 py-3 font-medium text-center">Jumlah</th>
                        <th class="px-6 py-3 font-medium text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($pesanan->items as $item)
                        <tr>
                            <td class="px-6 py-3 text-gray-900">{{ $item->nama_item }}</td>
                            <td class="px-6 py-3 text-center text-gray-600">{{ $item->jumlah }}</td>
                            <td class="px-6 py-3 text-right text-gray-700">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-100">
                        <td colspan="2" class="px-6 py-3.5 font-semibold text-gray-800">Total</td>
                        <td class="px-6 py-3.5 text-right font-extrabold text-gray-900">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Versi kartu: HP -->
            <div class="sm:hidden divide-y divide-gray-100">
                @foreach ($pesanan->items as $item)
                    <div class="flex items-center justify-between px-4 py-3">
                        <div class="pr-3">
                            <p class="text-sm text-gray-900">{{ $item->nama_item }}</p>
                            <p class="text-xs text-gray-400">x{{ $item->jumlah }}</p>
                        </div>
                        <span class="text-sm text-gray-700 font-medium shrink-0">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <div class="flex items-center justify-between px-4 py-3.5 bg-gray-50">
                    <span class="text-sm font-semibold text-gray-800">Total</span>
                    <span class="text-base font-extrabold text-gray-900">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>

        <!-- Hapus -->
        <form method="POST"
              action="{{ route('pesanan.destroy', $pesanan) }}"
              onsubmit="return confirm('Yakin mau hapus pesanan ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm text-red-500 hover:text-red-600 font-medium">
                Hapus pesanan ini
            </button>
        </form>

          <div class="flex justify-end">
                <a href="{{ route('pesanan.index') }}"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-gray-200 bg-white text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Tombol cetak -->
        <div class="flex justify-end">
            <button onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Struk
            </button>
        </div>

<!-- Struk -->
        <div class="hidden print:block p-6">
            <div class="text-center mb-4">
                <p class="font-extrabold text-lg">LIDO LAUNDRY</p>
                <p class="text-xs">Lido Lake Resort by MNC Hotel</p>
            </div>
            <div class="border-t border-dashed border-black my-2"></div>
            <p class="text-sm">Kode: {{ $pesanan->kode_pesanan }}</p>
            <p class="text-sm">Kamar: {{ $pesanan->nomor_kamar }}</p>
            @if ($pesanan->nama_tamu)
                <p class="text-sm">Tamu: {{ $pesanan->nama_tamu }}</p>
            @endif
            <p class="text-sm">Tanggal: {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
            <div class="border-t border-dashed border-black my-2"></div>
            @foreach ($pesanan->items as $item)
                <div class="flex justify-between text-sm">
                    <span>{{ $item->nama_item }} x{{ $item->jumlah }}</span>
                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <div class="border-t border-dashed border-black my-2"></div>
            <div class="flex justify-between font-bold text-sm">
                <span>TOTAL</span>
                <span>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
            </div>
            <p class="text-center text-xs mt-4">Terima kasih!</p>
        </div>

        <style>
            @media print {
                body * { visibility: hidden; }
                .print\:block, .print\:block * { visibility: visible; }
                .print\:block { position: absolute; top: 0; left: 0; width: 100%; }
            }
        </style>

    </div>

    </div>
</x-app-layout>