<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari filter
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        // Data laporan
        $query = DB::table('pesanans')
            ->leftJoin('pesanan_items', 'pesanans.id', '=', 'pesanan_items.pesanan_id')
            ->select(
                'pesanans.id',
                'pesanans.kode_pesanan',
                'pesanans.nomor_kamar',
                'pesanans.nama_tamu',
                'pesanans.status',
                'pesanans.created_at',
                'pesanans.total',
                DB::raw('GROUP_CONCAT(pesanan_items.nama_item SEPARATOR ", ") as nama_item'),
                DB::raw('SUM(pesanan_items.jumlah) as jumlah')
            )
            ->when($tanggalMulai, function ($query) use ($tanggalMulai) {
                $query->whereDate('pesanans.created_at', '>=', $tanggalMulai);
            })
            ->when($tanggalSelesai, function ($query) use ($tanggalSelesai) {
                $query->whereDate('pesanans.created_at', '<=', $tanggalSelesai);
            })
            ->groupBy(
                'pesanans.id',
                'pesanans.kode_pesanan',
                'pesanans.nomor_kamar',
                'pesanans.nama_tamu',
                'pesanans.status',
                'pesanans.created_at',
                'pesanans.total'
            )
            ->orderBy('pesanans.created_at', 'desc');

        $laporan = $query->get();

        // =========================
        // RINGKASAN LAPORAN
        // =========================

        $summaryQuery = DB::table('pesanans');

        if ($tanggalMulai) {
            $summaryQuery->whereDate('created_at', '>=', $tanggalMulai);
        }

        if ($tanggalSelesai) {
            $summaryQuery->whereDate('created_at', '<=', $tanggalSelesai);
        }

        $totalPesanan = $summaryQuery->count();
        $totalPendapatan = $summaryQuery->sum('total');

        $itemQuery = DB::table('pesanans')
            ->join('pesanan_items', 'pesanans.id', '=', 'pesanan_items.pesanan_id');

        if ($tanggalMulai) {
            $itemQuery->whereDate('pesanans.created_at', '>=', $tanggalMulai);
        }

        if ($tanggalSelesai) {
            $itemQuery->whereDate('pesanans.created_at', '<=', $tanggalSelesai);
        }

        $totalItem = $itemQuery->sum('pesanan_items.jumlah');

        return view('laporan.index', compact(
            'laporan',
            'totalPesanan',
            'totalPendapatan',
            'totalItem',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }

    public function export(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $namaFile = 'laporan-laundry';

        if ($tanggalMulai && $tanggalSelesai) {
            $namaFile .= '-' . $tanggalMulai . '-sampai-' . $tanggalSelesai;
        }

        $namaFile .= '.xlsx';

        return Excel::download(
            new LaporanExport($tanggalMulai, $tanggalSelesai),
            $namaFile
        );
    }
}