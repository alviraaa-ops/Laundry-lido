<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Tanggal hari ini
        $today = Carbon::today();

        // Pesanan yang dibuat hari ini
        $pesananHariIni = Pesanan::whereDate('created_at', $today)
            ->count();

        // Pendapatan dari pesanan hari ini
        $pendapatanHariIni = Pesanan::whereDate('created_at', $today)
            ->sum('total');

        // Semua pesanan yang masih sedang dicuci
        $sedangDicuci = Pesanan::where('status', 'dicuci')
            ->count();

        // Semua pesanan yang sudah siap diambil
        $siapDiambil = Pesanan::where('status', 'siap_diambil')
            ->count();

        // Pesanan terbaru hari ini
        $pesananTerbaru = Pesanan::whereDate('created_at', $today)
            ->with('items')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'pesananHariIni',
            'pendapatanHariIni',
            'sedangDicuci',
            'siapDiambil',
            'pesananTerbaru'
        ));
    }
}