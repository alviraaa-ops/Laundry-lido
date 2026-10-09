<x-app-layout>

    <div class="max-w-3xl mx-auto"
         x-data="pesananForm()">

        <form method="POST" action="{{ route('pesanan.store') }}" @submit="beforeSubmit">
            @csrf

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

                <div>
                    <label for="nomor_kamar" class="block text-sm font-semibold text-gray-800 mb-1.5">Nomor Kamar</label>
                    <input type="text" id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar') }}"
                           placeholder="Contoh: 301"
                           class="w-full sm:w-48 px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                    @error('nomor_kamar')
                        <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_tamu" class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Tamu <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" id="nama_tamu" name="nama_tamu" value="{{ old('nama_tamu') }}"
                        placeholder="Contoh: Bu Siti"
                        class="w-full sm:w-64 px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                    @error('nama_tamu')
                        <p class="text-xs text-red-600 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Barang / Layanan</label>

                    <datalist id="daftar-barang">
                        <template x-for="item in items" :key="item.id">
                            <option :value="item.nama_item + ' — Rp ' + formatRupiah(item.harga)"></option>
                        </template>
                    </datalist>

                    <div class="space-y-2">
                        <template x-for="(row, index) in rows" :key="index">
                            <div class="flex items-center gap-2">
                                <input type="text" list="daftar-barang" x-model="row.query" @input="selectItem(row)"
                                       placeholder="Ketik nama barang..."
                                       class="flex-1 px-3 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                                <input type="number" min="1" x-model.number="row.jumlah" @input="updateSubtotal(row)"
                                       class="w-20 px-3 py-2 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500">
                                <span class="w-28 text-sm text-gray-600 text-right" x-text="'Rp ' + formatRupiah(row.subtotal)"></span>
                                <button type="button" @click="removeRow(index)" class="text-red-400 hover:text-red-500 px-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>

                    <button type="button" @click="addRow()"
                            class="mt-3 text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah barang
                    </button>

                    @error('items')
                        <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700">Total</span>
                    <span class="text-lg font-extrabold text-gray-900" x-text="'Rp ' + formatRupiah(grandTotal())"></span>
                </div>

            </div>

            <!-- hidden inputs biar kekirim ke server -->
            <template x-for="(row, index) in rows" :key="'hidden-' + index">
                <div>
                    <input type="hidden" :name="'items[' + index + '][price_id]'" :value="row.price_id">
                    <input type="hidden" :name="'items[' + index + '][jumlah]'" :value="row.jumlah">
                </div>
            </template>

            <div class="flex items-center gap-3 mt-5">
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">
                    Simpan Pesanan
                </button>
                <a href="{{ route('pesanan.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function pesananForm() {
            return {
                items: @json($items->map(fn($i) => ['id' => $i->id, 'nama_item' => $i->nama_item, 'harga' => (float) $i->harga])),
                rows: [{ query: '', price_id: '', jumlah: 1, subtotal: 0 }],
                addRow() {
                    this.rows.push({ query: '', price_id: '', jumlah: 1, subtotal: 0 });
                },
                removeRow(index) {
                    if (this.rows.length > 1) {
                        this.rows.splice(index, 1);
                    }
                },
                selectItem(row) {
                    const found = this.items.find(i => (i.nama_item + ' — Rp ' + this.formatRupiah(i.harga)) === row.query);
                    row.price_id = found ? found.id : '';
                    this.updateSubtotal(row);
                },
                updateSubtotal(row) {
                    const item = this.items.find(i => i.id === row.price_id);
                    row.subtotal = item ? item.harga * (row.jumlah || 0) : 0;
                },
                grandTotal() {
                    return this.rows.reduce((sum, r) => sum + (r.subtotal || 0), 0);
                },
                formatRupiah(n) {
                    return new Intl.NumberFormat('id-ID').format(n || 0);
                },
                beforeSubmit() {
                    this.rows.forEach(r => this.updateSubtotal(r));
                }
            }
        }
    </script>
</x-app-layout>