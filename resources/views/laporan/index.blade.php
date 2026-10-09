<x-app-layout>

    <div class="py-5 sm:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-5 mb-5">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>

                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Filter Periode
                        </h2>

                        <p class="text-xs text-slate-500">
                            Pilih periode transaksi yang ingin ditampilkan.
                        </p>
                    </div>

                </div>


                <form method="GET" action="{{ route('laporan.index') }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">


                        {{-- DARI --}}
                        <div>

                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                value="{{ $tanggalMulai ?? '' }}"
                                class="w-full h-11 rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- SAMPAI --}}
                        <div>

                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                value="{{ $tanggalSelesai ?? '' }}"
                                class="w-full h-11 rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                            >

                        </div>


                        {{-- TAMPILKAN --}}
                        <div class="sm:col-span-1 lg:col-span-1 flex items-end">

                            <button
                                type="submit"
                                class="w-full h-11 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 4h18M6 8h12M10 12h4M11 16h2M12 20v-4"/>
                                </svg>

                                Tampilkan

                            </button>

                        </div>


                        {{-- EXPORT --}}
                        <div class="sm:col-span-1 lg:col-span-1 flex items-end">

                            <a
                                href="{{ route('laporan.export', [
                                    'tanggal_mulai' => $tanggalMulai,
                                    'tanggal_selesai' => $tanggalSelesai
                                ]) }}"
                                class="w-full h-11 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14a2 2 0 002-2v-3M3 16v3a2 2 0 002 2"/>
                                </svg>

                                Export Excel

                            </a>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =========================
                 RINGKASAN
            ========================== --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-5">


                {{-- TOTAL PESANAN --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 sm:p-5">

                    <div class="flex items-center justify-between gap-2">

                        <div class="min-w-0">

                            <p class="text-[11px] sm:text-sm font-medium text-slate-500">
                                Total Pesanan
                            </p>

                            <h3 class="text-xl sm:text-3xl font-bold text-slate-800 mt-1">
                                {{ $totalPesanan }}
                            </h3>

                            <p class="text-[10px] sm:text-xs text-slate-400 mt-1">
                                Transaksi
                            </p>

                        </div>


                        <div class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 sm:w-5 sm:h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 016 0M9 5h6"/>
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- TOTAL ITEM --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-3 sm:p-5">

                    <div class="flex items-center justify-between gap-2">

                        <div class="min-w-0">

                            <p class="text-[11px] sm:text-sm font-medium text-slate-500">
                                Total Item Laundry
                            </p>

                            <h3 class="text-xl sm:text-3xl font-bold text-slate-800 mt-1">
                                {{ $totalItem }}
                            </h3>

                           
                        </div>

                        <div class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 sm:w-5 sm:h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- TOTAL PENDAPATAN --}}
                <div class="col-span-2 sm:col-span-1 bg-white rounded-2xl border border-slate-100 shadow-sm p-3 sm:p-5">

                    <div class="flex items-center justify-between gap-3">

                        <div class="min-w-0">

                            <p class="text-[11px] sm:text-sm font-medium text-slate-500">
                                Total Pendapatan
                            </p>

                            <h3 class="text-lg sm:text-2xl font-bold text-slate-800 mt-1 truncate">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h3>

                            <p class="text-[10px] sm:text-xs text-slate-400 mt-1">
                                Pendapatan transaksi
                            </p>

                        </div>


                        <div class="w-8 h-8 sm:w-10 sm:h-10 flex-shrink-0 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 sm:w-5 sm:h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m9-4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
                 REKAP TRANSAKSI
            ========================== --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">


                {{-- HEADER REKAP --}}
                <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-slate-100">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                        <div>

                            <h2 class="text-base sm:text-lg font-bold text-slate-800">
                                Rekap Transaksi Laundry
                            </h2>

                            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                Satu baris mewakili satu transaksi laundry.
                            </p>

                        </div>

                        <div class="text-xs text-slate-400">
                            {{ $laporan->count() }} transaksi
                        </div>

                    </div>

                </div>


                {{-- =========================
                     DESKTOP TABLE
                ========================== --}}
                <div class="hidden md:block overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50">

                            <tr class="text-left text-slate-600">

                                <th class="px-5 py-4 font-semibold">
                                    No
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Kode Pesanan
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Tanggal
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Nama Tamu
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Barang Laundry
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Jumlah
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Total
                                </th>

                                <th class="px-5 py-4 font-semibold">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse($laporan as $index => $data)

                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-5 py-4 text-slate-500">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold text-slate-800 whitespace-nowrap">
                                        {{ $data->kode_pesanan ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $data->nama_tamu ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700 max-w-xs">
                                        {{ $data->nama_item ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-slate-700">
                                        {{ $data->jumlah ?? 0 }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold text-slate-800 whitespace-nowrap">
                                        Rp {{ number_format($data->total ?? 0, 0, ',', '.') }}
                                    </td>

                                    <td class="px-5 py-4">

                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                            {{ ucfirst($data->status ?? '-') }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="px-5 py-12 text-center text-slate-500"
                                    >
                                        Belum ada data laporan.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =========================
                     MOBILE CARD
                ========================== --}}
                <div class="md:hidden">

                    @forelse($laporan as $index => $data)

                        <div class="p-4 border-b border-slate-100 last:border-b-0">


                            <div class="flex items-start justify-between gap-3">

                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-slate-800 truncate">
                                        {{ $data->kode_pesanan ?? '-' }}
                                    </p>

                                    <p class="text-xs text-slate-500 mt-1">
                                        {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}
                                    </p>

                                </div>


                                <span class="flex-shrink-0 inline-flex px-2.5 py-1 rounded-full text-[11px] font-medium bg-slate-100 text-slate-700">
                                    {{ ucfirst($data->status ?? '-') }}
                                </span>

                            </div>


                            <div class="mt-4 space-y-2.5">


                                {{-- TAMU --}}
                                <div class="flex items-start justify-between gap-4">

                                    <span class="text-xs text-slate-400">
                                        Tamu
                                    </span>

                                    <span class="text-sm font-medium text-slate-700 text-right">
                                        {{ $data->nama_tamu ?? '-' }}
                                    </span>

                                </div>


                                {{-- BARANG --}}
                                <div class="flex items-start justify-between gap-4">

                                    <span class="text-xs text-slate-400">
                                        Laundry
                                    </span>

                                    <span class="text-sm text-slate-700 text-right max-w-[65%]">
                                        {{ $data->nama_item ?? '-' }}
                                    </span>

                                </div>


                                {{-- JUMLAH --}}
                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-xs text-slate-400">
                                        Jumlah
                                    </span>

                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $data->jumlah ?? 0 }} item
                                    </span>

                                </div>


                                {{-- TOTAL --}}
                                <div class="pt-2.5 mt-1 border-t border-slate-100 flex items-center justify-between gap-4">

                                    <span class="text-xs font-medium text-slate-500">
                                        Total
                                    </span>

                                    <span class="text-sm font-bold text-slate-800">
                                        Rp {{ number_format($data->total ?? 0, 0, ',', '.') }}
                                    </span>

                                </div>


                            </div>

                        </div>

                    @empty

                        <div class="px-4 py-12 text-center text-slate-500 text-sm">
                            Belum ada data laporan.
                        </div>

                    @endforelse

                </div>


            </div>

        </div>
    </div>

</x-app-layout>