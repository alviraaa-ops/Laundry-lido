<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kamars = Pesanan::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nomor_kamar', 'like', '%' . $search . '%')
                      ->orWhere('nama_tamu', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('nomor_kamar')
            ->map(function ($group) {
                return [
                    'nomor_kamar' => $group->first()->nomor_kamar,
                    'nama_tamu' => $group->first()->nama_tamu,
                    'status_terakhir' => $group->first()->status,
                    'pesanan_terakhir' => $group->first(),
                    'jumlah_pesanan' => $group->count(),
                ];
            })
            ->sortBy('nomor_kamar');

        return view('kamar.index', compact('kamars', 'search'));
    }
}