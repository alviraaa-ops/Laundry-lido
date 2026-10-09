<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PublicTrackController extends Controller
{
    public function index(Request $request)
    {
        $pesanan = null;
        $notFound = false;

        if ($request->filled('kode')) {
            $pesanan = Pesanan::with('items')
                ->where('kode_pesanan', strtoupper(trim($request->kode)))
                ->first();

            if (!$pesanan) {
                $notFound = true;
            }
        }

        return view('public.lacak', compact('pesanan', 'notFound'));
    }
}