<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lacak Status Laundry</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 min-h-screen">

    <div class="max-w-md mx-auto px-4 py-10">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2.5 mb-3">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-white ring-1 ring-gray-200 flex items-center justify-center">
                    <img src="{{ asset('images/Lidologo.png') }}" alt="Logo Lido Lake Resort" class="w-full h-full object-contain p-1">
                </div>
                <span class="text-xl font-extrabold text-blue-950">Lido Laundry</span>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900">Lacak Status Laundry</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan kode pesanan yang diberikan staf.</p>
        </div>

        <!-- Form cari kode -->
        <form method="GET" action="{{ route('public.lacak') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex gap-2 mb-6">
            <input type="text" name="kode" value="{{ request('kode') }}" placeholder="Contoh: LDY-0001"
                   class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                Cari
            </button>
        </form>

        @if ($notFound)
            <div class="bg-red-50 text-red-700 text-sm rounded-2xl p-4 text-center">
                Kode pesanan tidak ditemukan. Pastikan kode sudah benar.
            </div>
        @endif

        @if ($pesanan)
            @php
                $steps = ['diproses', 'dicuci', 'siap_diambil', 'selesai'];
                $labels = ['Diproses', 'Sedang Dicuci', 'Siap Diambil', 'Selesai'];
                $currentIndex = array_search($pesanan->status, $steps);
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <p class="text-xs text-gray-400">Kode Pesanan</p>
                        <p class="text-lg font-extrabold text-gray-900 tracking-wider">{{ $pesanan->kode_pesanan }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400">Kamar</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $pesanan->nomor_kamar }}</p>
                        @if ($pesanan->nama_tamu)
                            <p class="text-xs text-gray-500">{{ $pesanan->nama_tamu }}</p>
                        @endif
                    </div>
                </div>

                <!-- Progress status -->
                <div class="flex items-center mb-6">
                    @foreach ($steps as $i => $step)
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold
                                {{ $i <= $currentIndex ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-400' }}">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-[10px] text-center mt-1.5 {{ $i <= $currentIndex ? 'text-blue-700 font-semibold' : 'text-gray-400' }}">
                                {{ $labels[$i] }}
                            </p>
                        </div>
                        @if (!$loop->last)
                            <div class="flex-1 h-0.5 -mt-4 {{ $i < $currentIndex ? 'bg-blue-600' : 'bg-gray-100' }}"></div>
                        @endif
                    @endforeach
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-2">
                    @foreach ($pesanan->items as $item)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-700">{{ $item->nama_item }} x{{ $item->jumlah }}</span>
                            <span class="text-gray-500">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                    <div class="flex items-center justify-between text-sm font-bold pt-2 border-t border-gray-100">
                        <span class="text-gray-800">Total</span>
                        <span class="text-gray-900">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @endif

    </div>

</body>
</html>