<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        $query = Price::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_item', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $prices = $query->latest()->paginate(15)->withQueryString();

        $categories = Price::select('kategori')->distinct()->pluck('kategori');

        return view('prices.index', compact('prices', 'categories'));
    }

    private function pastikanAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang boleh mengubah data harga.');
        }
    }

    public function create()
    {
        $this->pastikanAdmin();

        $categories = Price::select('kategori')->distinct()->pluck('kategori');

        return view('prices.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->pastikanAdmin();

        $validated = $request->validate([
            'nama_item' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Price::create($validated);

        return redirect()->route('prices.index')->with('status', 'Barang baru berhasil ditambahkan.');
    }

    public function edit(Price $price)
    {
        $this->pastikanAdmin();

        $categories = Price::select('kategori')->distinct()->pluck('kategori');

        return view('prices.edit', compact('price', 'categories'));
    }

    public function update(Request $request, Price $price)
    {
        $this->pastikanAdmin();

        $validated = $request->validate([
            'nama_item' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $price->update($validated);

        return redirect()->route('prices.index')->with('status', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Price $price)
    {
        $this->pastikanAdmin();

        $price->delete();

        return redirect()->route('prices.index')->with('status', 'Barang berhasil dihapus.');
    }
}