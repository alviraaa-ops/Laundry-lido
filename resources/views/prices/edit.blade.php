<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded-xl shadow-sm">

                <form method="POST" action="{{ route('prices.update', $price) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama_item" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang / Layanan</label>
                        <input type="text" id="nama_item" name="nama_item" value="{{ old('nama_item', $price->nama_item) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('nama_item')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $price->kategori) }}" list="daftar-kategori"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                        <datalist id="daftar-kategori">
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                        </datalist>
                        @error('kategori')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                            <input type="number" step="0.01" min="0" id="harga" name="harga" value="{{ old('harga', $price->harga) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('harga')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                            <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $price->satuan) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('satuan')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700">
                            <option value="aktif" {{ old('status', $price->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $price->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('prices.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>

            </div>

            <!-- Form hapus DIPISAH, bukan lagi di dalam form edit di atas -->
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <p class="text-sm text-gray-500 mb-3">Hapus barang ini dari daftar harga secara permanen.</p>
                <form method="POST" action="{{ route('prices.destroy', $price) }}"
                      onsubmit="return confirm('Yakin mau hapus {{ $price->nama_item }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm text-red-500 hover:text-red-600 font-medium">Hapus barang ini</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>