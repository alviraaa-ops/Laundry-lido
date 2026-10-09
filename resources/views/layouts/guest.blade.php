<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full overflow-hidden">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LaundryPro') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50 h-full overflow-hidden">
        <div class="h-full w-full lg:grid lg:grid-cols-2 overflow-hidden">

            <!-- SISI KIRI (Khusus Laptop/Desktop) -->
            <div class="relative hidden lg:flex flex-col justify-between bg-gradient-to-br from-blue-950 via-[#0F1B3D] to-[#0B1330] p-10 xl:p-14 overflow-hidden">
                <!-- Background Aesthetics -->
                <div class="pointer-events-none absolute left-8 top-8 w-28 h-28 opacity-20"
                     style="background-image: radial-gradient(rgba(255,255,255,0.8) 1px, transparent 1px); background-size: 14px 14px;"></div>
                <div class="pointer-events-none absolute -right-20 top-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-blue-500/15 blur-3xl"></div>
                <div class="pointer-events-none absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-indigo-600/15 blur-3xl"></div>

                <!-- Header Logo -->
                <div class="relative flex items-center gap-3 z-10">
                   <div class="w-10 h-10 rounded-full overflow-hidden bg-white ring-1 ring-white/20 flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/Lidologo.png') }}" alt="Logo Lido Lake Resort" class="w-full h-full object-contain p-1">
                </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-lg font-bold text-white tracking-tight"> Lido Laundry</span>
                        </div>
                        <p class="text-blue-300/80 text-[11px]">Panel Laundry Hotel</p>
                    </div>
                </div>

                <!-- Grid Konten Kiri -->
                <div class="relative my-auto py-6 grid grid-cols-12 gap-6 items-center z-10">
                    <div class="col-span-6 space-y-5">
                        <div>
                            <h1 class="text-2xl xl:text-3xl font-extrabold text-white leading-tight mb-2">
                                Setiap kamar, setiap pesanan,
                                <span class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">tercatat rapi.</span>
                            </h1>
                            <p class="text-blue-200/75 text-xs leading-relaxed">
                                Kelola pesanan laundry tamu, lacak status cucian, dan pantau semuanya dari satu tempat.
                            </p>
                        </div>

                        <div class="space-y-3 pt-1">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 shrink-0 rounded-lg bg-blue-600/30 flex items-center justify-center text-blue-300 border border-blue-500/30">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2h-3.28a1 1 0 01-.95-.68l-.44-1.32A1 1 0 0013.36 2h-2.72a1 1 0 00-.95.68l-.44 1.32a1 1 0 01-.95.68H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-xs font-semibold">Kelola Pesanan</p>
                                    <p class="text-blue-200/60 text-[11px]">Terima & kelola pesanan mudah.</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 shrink-0 rounded-lg bg-indigo-600/30 flex items-center justify-center text-indigo-300 border border-indigo-500/30">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4l8 4-8 4-8-4 8-4zM4 12l8 4 8-4M4 16l8 4 8-4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-xs font-semibold">Pantau Status</p>
                                    <p class="text-blue-200/60 text-[11px]">Lacak status cucian real-time.</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 shrink-0 rounded-lg bg-emerald-600/30 flex items-center justify-center text-emerald-300 border border-emerald-500/30">
                                    <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-xs font-semibold">Laporan Rapi</p>
                                    <p class="text-blue-200/60 text-[11px]">Data tersimpan aman & rapi.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 flex justify-center items-center relative">
                        <div class="absolute w-44 h-44 rounded-full bg-blue-500/20 blur-2xl"></div>
                        <img src="{{ asset('images/laundry2.png') }}" alt="Laundry Illustration" class="relative max-h-60 w-auto object-contain filter drop-shadow-[0_15px_25px_rgba(0,0,0,0.35)] transition-transform duration-300 hover:scale-105">
                    </div>
                </div>

                <p class="relative text-[11px] text-blue-300/50 z-10">© {{ date('Y') }} LaundryPro — untuk staf internal hotel.</p>
            </div>

            <!-- SISI KANAN / FORM LOGIN (Dikunci Ukuran Full tanpa Scroll) -->
            <div class="relative h-full flex flex-col justify-center items-center px-5 py-4 bg-slate-50 overflow-hidden">
                <div class="pointer-events-none absolute right-0 top-0 w-64 h-64 rounded-full bg-indigo-100/50 blur-3xl"></div>
                <div class="pointer-events-none absolute left-0 bottom-0 w-56 h-56 rounded-full bg-blue-100/40 blur-3xl"></div>

                <div class="relative w-full max-w-sm flex flex-col justify-center h-full max-h-screen">

                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>