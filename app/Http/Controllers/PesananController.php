<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::query()->withCount('items');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pesanans = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $items = Price::where('status', 'aktif')
            ->orderBy('nama_item')
            ->get();

        return view('pesanan.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:50',
            'nama_tamu' => 'nullable|string|max:255',

            'items' => 'required|array|min:1',
            'items.*.price_id' => 'required|exists:prices,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $pesanan = DB::transaction(function () use ($validated) {

            // Buat pesanan baru
            $pesanan = Pesanan::create([
                'nomor_kamar' => $validated['nomor_kamar'],
                'nama_tamu' => $validated['nama_tamu'] ?? null,

                // Status awal
                'status' => 'diproses',

                'total' => 0,
            ]);

            $total = 0;

            // Simpan item pesanan
            foreach ($validated['items'] as $item) {

                $price = Price::findOrFail($item['price_id']);

                $subtotal = $price->harga * $item['jumlah'];

                $total += $subtotal;

                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    'price_id' => $price->id,
                    'nama_item' => $price->nama_item,
                    'harga_satuan' => $price->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ]);
            }

            // Update total pesanan
           $pesanan->update([
                'total' => $total,
                'kode_pesanan' => 'LDY-' . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT),

            ]);

            return $pesanan;
        });

        return redirect()
            ->route('pesanan.show', $pesanan)
            ->with('status', 'Pesanan baru berhasil dibuat.');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load('items');

        return view('pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status' => 'required|in:diproses,dicuci,siap_diambil,selesai',
        ]);

        $pesanan->update([
            'status' => $validated['status']
        ]);

        return redirect()
            ->route('pesanan.show', $pesanan)
            ->with('status', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()
            ->route('pesanan.index')
            ->with('status', 'Pesanan berhasil dihapus.');
    }
}