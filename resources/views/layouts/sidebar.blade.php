<!-- Sidebar -->

<aside
    x-data="{ mobileOpen: false }"
    x-effect="document.body.style.overflow = mobileOpen ? 'hidden' : ''"
    @keydown.escape.window="mobileOpen = false"
    class="lg:w-72 w-full lg:shrink-0">

    <!-- ========================= MOBILE TOP BAR ========================== -->
    <div class="lg:hidden flex items-center justify-between bg-blue-950 px-4 py-3">

        <div class="flex items-center gap-2">

            <div class="w-8 h-8 rounded-full overflow-hidden bg-white flex items-center justify-center shrink-0">
                <img
                    src="{{ asset('images/Lidologo.png') }}"
                    alt="Logo Lido Lake Resort"
                    class="w-full h-full object-contain p-0.5"
                >
            </div>
            <span class="text-white font-extrabold text-sm"> Lido Laundry </span>

        </div>


        <!-- Tombol Hamburger -->
        <button
            @click="mobileOpen = true"
            type="button"
            aria-label="Buka menu"
            class="w-9 h-9 rounded-xl flex items-center justify-center text-white hover:bg-white/10 transition"
        >

            <svg
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>

        </button>

    </div>


    <!-- =========================
         OVERLAY BLUR
    ========================== -->
    <div
        x-show="mobileOpen"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileOpen = false"
        class="lg:hidden fixed inset-0 bg-slate-950/40 backdrop-blur-md z-40"
        style="display: none;"
    ></div>


    <!-- =========================
         SIDEBAR PANEL
    ========================== -->
    <div
        :class="mobileOpen ? 'translate-x-0' : '-translate-x-full'"
        class="
            fixed inset-y-0 left-0 z-50
            w-64
            transform transition-transform duration-300 ease-in-out
            lg:translate-x-0 lg:static lg:sticky lg:top-0
            flex flex-col
            h-screen
            bg-blue-950
            px-4 sm:px-5 py-5
            overflow-hidden
            rounded-r-2xl lg:rounded-none
        "
    >

        <!-- =========================
             HEADER LOGO MOBILE
        ========================== -->
        <div class="lg:hidden flex items-center justify-between pb-4 mb-4 border-b border-white/10 shrink-0">

            <div class="flex items-center gap-2.5">

                <div class="w-9 h-9 rounded-full overflow-hidden bg-white flex items-center justify-center shrink-0">
                    <img
                        src="{{ asset('images/Lidologo.png') }}"
                        alt="Logo Lido Laundry"
                        class="w-full h-full object-contain p-1"
                    >
                </div>

                <div>

                    <p class="text-white font-extrabold text-sm leading-tight">
                        Lido Laundry
                    </p>

                    <p class="text-blue-300/80 text-[10px] uppercase tracking-wider font-semibold mt-0.5">
                        Panel Staf Laundry
                    </p>

                </div>

            </div>


            <!-- Tombol Tutup -->
            <button
                @click="mobileOpen = false"
                type="button"
                aria-label="Tutup menu"
                class="w-8 h-8 rounded-lg flex items-center justify-center text-blue-200 hover:bg-white/10 hover:text-white transition"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        <!-- =========================
             LOGO DESKTOP
        ========================== -->
        <div class="hidden lg:flex items-center gap-2.5 px-2 mb-8 shrink-0">

            <div class="w-10 h-10 rounded-full overflow-hidden bg-white ring-1 ring-gray-100 flex items-center justify-center shrink-0">

                <img
                    src="{{ asset('images/Lidologo.png') }}"
                    alt="Logo Lido Lake Resort"
                    class="w-full h-full object-contain p-1"
                >

            </div>


            <div>

                <p class="text-white font-extrabold text-base leading-tight tracking-tight">
                    Lido Laundry
                </p>

                <p class="text-blue-300/80 text-[11px] uppercase tracking-wider font-semibold mt-1">
                    Panel Staf Laundry
                </p>

            </div>

        </div>


        <!-- =========================
             MENU
        ========================== -->
        <nav class="flex-1 min-h-0 overflow-y-auto space-y-1 pr-1">


            <!-- BERANDA -->
            <a
                href="{{ route('dashboard') }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-white/10 text-white'
                    : 'text-blue-200/70 hover:bg-white/5 hover:text-white' }}"
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001 1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    />
                </svg>

                Beranda

            </a>


            <!-- PESANAN -->
            <a
                href="{{ Route::has('pesanan.index') ? route('pesanan.index') : '#' }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('pesanan.*')
                    ? 'bg-white/10 text-white'
                    : 'text-blue-200/70 hover:bg-white/5 hover:text-white' }}"
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12h6m-6 4h6M9 8h1M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2h-3.28a1 1 0 01-.95-.68l-.44-1.32A1 1 0 0013.36 2h-2.72a1 1 0 00-.95.68l-.44 1.32A1 1 0 005 5H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                    />
                </svg>

                Pesanan

            </a>


            <!-- HARGA -->
            <a
                href="{{ Route::has('prices.index') ? route('prices.index') : '#' }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('prices.*')
                    ? 'bg-white/10 text-white'
                    : 'text-blue-200/70 hover:bg-white/5 hover:text-white' }}"
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l6.414 6.414a1 1 0 010 1.414l-7.586 7.586a1 1 0 01-1.414 0L3.293 12.293A1 1 0 013 11.586V6a3 3 0 013-3z"
                    />
                </svg>

                Harga

            </a>


            <!-- KAMAR -->
            <a
                href="{{ Route::has('kamar.index') ? route('kamar.index') : '#' }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('kamar.*')
                    ? 'bg-white/10 text-white'
                    : 'text-blue-200/70 hover:bg-white/5 hover:text-white' }}"
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7M9 9v.01M9 12v.01M9 15v.01"
                    />
                </svg>

                Kamar

            </a>


            <!-- LAPORAN -->
            <a
                href="{{ Route::has('laporan.index') ? route('laporan.index') : '#' }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('laporan.*')
                    ? 'bg-white/10 text-white'
                    : 'text-blue-200/70 hover:bg-white/5 hover:text-white' }}"
            >

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 19V5a2 2 0 012-2h12a2 2 0 012 2v14M4 19h16M8 16v-4m4 4V8m4 8v-6"
                    />
                </svg>

                Laporan

            </a>

        </nav>


        <!-- =========================
             BAGIAN BAWAH SIDEBAR
        ========================== -->
        <div class="shrink-0 mt-4">


            <!-- INFO SHIFT -->
            <div class="rounded-xl bg-white/5 border border-white/10 px-4 py-3">

                <div class="flex items-center gap-2 mb-1">

                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>

                    <p class="text-xs text-blue-200/70">
                        Shift aktif
                    </p>

                </div>

                <p class="text-white text-sm font-semibold">
                    Pagi · 07.00–15.00
                </p>

            </div>


            <!-- PROFIL & LOGOUT -->
            @auth

            <div class="mt-3 pt-3 border-t border-white/10">

                <div class="flex items-center gap-3 px-2 mb-1.5">

                    <!-- Avatar -->
                    <div class="w-9 h-9 rounded-full bg-indigo-500/30 flex items-center justify-center text-white text-sm font-semibold shrink-0">

                        {{ strtoupper(substr(Auth::user()->role ?? 'S', 0, 1)) }}

                    </div>


                    <!-- Nama / Role -->
                    <div class="min-w-0">

                        <p class="text-white text-sm font-medium truncate">

                            {{ ucfirst(Auth::user()->role ?? 'Staf') }}

                        </p>

                        @if (Route::has('profile.edit'))

                            <a
                                href="{{ route('profile.edit') }}"
                                class="text-blue-300/70 text-xs hover:text-blue-200"
                            >

                                Edit profil

                            </a>

                        @endif

                    </div>

                </div>


                <!-- LOGOUT -->
                @if (Route::has('logout'))

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium text-blue-200/70 hover:bg-white/5 hover:text-white transition"
                        >

                            <svg
                                class="w-[18px] h-[18px]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />

                            </svg>

                            Keluar

                        </button>

                    </form>

                @endif

            </div>

            @endauth

        </div>

    </div>

</aside>