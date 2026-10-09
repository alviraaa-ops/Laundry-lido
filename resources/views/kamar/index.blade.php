<x-app-layout>

    <div class="max-w-4xl mx-auto space-y-4">

        <form method="GET" action="{{ route('kamar.index') }}" class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm flex flex-col sm:flex-row gap-2">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nomor kamar atau nama tamu..."
                   class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium">Cari</button>
                @if ($search)
                    <a href="{{ route('kamar.index') }}" class="flex-1 sm:flex-none flex items-center justify-center px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700">Reset</a>
                @endif
            </div>
        </form>

        @php
            $statusStyle = [
                'diproses' => 'bg-amber-100 text-amber-700',
                'dicuci' => 'bg-blue-100 text-blue-700',
                'siap_diambil' => 'bg-purple-100 text-purple-700',
                'selesai' => 'bg-emerald-100 text-emerald-700',
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
            @if ($kamars->isEmpty())
                <div class="p-10 text-center text-sm text-gray-400">
                    Belum ada kamar yang pernah pesan laundry.
                </div>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 text-left text-gray-500">
                            <th class="px-6 py-3.5 font-medium">Kamar</th>
                            <th class="px-6 py-3.5 font-medium">Tamu</th>
                            <th class="px-6 py-3.5 font-medium">Status Terakhir</th>
                            <th class="px-6 py-3.5 font-medium">Total Pesanan</th>
                            <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($kamars as $kamar)
                            <tr>
                                <td class="px-6 py-3.5 text-gray-900 font-medium">Kamar {{ $kamar['nomor_kamar'] }}</td>
                                <td class="px-6 py-3.5 text-gray-600">{{ $kamar['nama_tamu'] ?? '-' }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $statusStyle[$kamar['status_terakhir']] }}">{{ $statusLabel[$kamar['status_terakhir']] }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-gray-600">{{ $kamar['jumlah_pesanan'] }} pesanan</td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="{{ route('pesanan.show', $kamar['pesanan_terakhir']) }}" class="text-blue-600 hover:text-blue-700 font-medium">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- ===== Versi KARTU (HP / layar kecil) ===== -->
        <div class="md:hidden space-y-3">
            @forelse ($kamars as $kamar)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">Kamar {{ $kamar['nomor_kamar'] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $kamar['nama_tamu'] ?? '-' }}</p>
                        </div>
                        <span class="shrink-0 px-2.5 py-1 text-xs font-medium rounded-full {{ $statusStyle[$kamar['status_terakhir']] }}">
                            {{ $statusLabel[$kamar['status_terakhir']] }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-500">{{ $kamar['jumlah_pesanan'] }} pesanan</span>
                        <a href="{{ route('pesanan.show', $kamar['pesanan_terakhir']) }}" class="text-blue-600 text-sm font-medium">Lihat</a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-sm text-gray-400">
                    Belum ada kamar yang pernah pesan laundry.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>