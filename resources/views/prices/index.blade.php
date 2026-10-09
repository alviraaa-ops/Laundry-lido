<x-app-layout>

    <div class="max-w-5xl mx-auto space-y-4">

        @if (session('status'))
            <div class="rounded-2xl bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <!-- Area Filter & Search -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 space-y-3">
            <form method="GET" action="{{ route('prices.index') }}" class="flex flex-col sm:flex-row gap-2.5">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..."
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">

                <select name="kategori" onchange="this.form.submit()"
                        class="w-full sm:w-44 px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-semibold hover:bg-gray-800 transition">
                    Cari
                </button>
            </form>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('prices.create') }}"
                   class="flex items-center justify-center gap-2 w-full sm:w-auto sm:inline-flex px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Barang Baru
                </a>
            @endif
        </div>

        <!-- ===== Versi TABEL (laptop/tablet ke atas) ===== -->
        <div class="hidden md:block bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-left text-gray-500">
                        <th class="px-6 py-3.5 font-medium">Nama Barang / Layanan</th>
                        <th class="px-6 py-3.5 font-medium">Kategori</th>
                        <th class="px-6 py-3.5 font-medium">Harga</th>
                        <th class="px-6 py-3.5 font-medium">Status</th>
                        <th class="px-6 py-3.5 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($prices as $price)
                        <tr class="hover:bg-gray-50/60">
                            <td class="px-6 py-3.5 font-medium text-gray-900">{{ $price->nama_item }}</td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $price->kategori }}</span>
                            </td>
                            <td class="px-6 py-3.5 font-semibold text-gray-900">Rp {{ number_format($price->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-3.5">
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $price->status == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($price->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-right">
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('prices.edit', $price) }}" class="text-blue-600 hover:text-blue-700 font-medium">Edit</a>
                                @else
                                    <span class="text-gray-300 text-xs">Khusus admin</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-400">Tidak ada data barang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-gray-100">
                {{ $prices->links() }}
            </div>
        </div>

        <!-- ===== Versi KARTU (HP / layar kecil) ===== -->
        <div class="md:hidden space-y-3">
            @forelse($prices as $price)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <p class="font-semibold text-gray-900 text-sm leading-snug">{{ $price->nama_item }}</p>
                        <span class="shrink-0 px-2.5 py-1 text-xs font-medium rounded-full {{ $price->status == 'aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($price->status) }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">{{ $price->kategori }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-base font-extrabold text-gray-900">Rp {{ number_format($price->harga, 0, ',', '.') }}</span>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('prices.edit', $price) }}" class="text-blue-600 text-sm font-medium">Edit</a>
                        @else
                            <span class="text-gray-300 text-xs">Khusus admin</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center text-sm text-gray-400">
                    Tidak ada data barang ditemukan.
                </div>
            @endforelse

            <div class="pt-2">
                {{ $prices->links() }}
            </div>
        </div>

    </div>
</x-app-layout>