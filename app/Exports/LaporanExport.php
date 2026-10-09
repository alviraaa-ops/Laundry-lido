<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanExport implements FromArray, WithStyles, WithEvents, WithTitle
{
    protected $tanggalMulai;
    protected $tanggalSelesai;

    public function __construct($tanggalMulai = null, $tanggalSelesai = null)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
    }


    // =========================================================
    // DATA EXCEL
    // =========================================================

    public function array(): array
    {
        // =====================================================
        // AMBIL DATA TRANSAKSI
        // =====================================================

        $query = DB::table('pesanans')
            ->leftJoin(
                'pesanan_items',
                'pesanans.id',
                '=',
                'pesanan_items.pesanan_id'
            )
            ->select(
                'pesanans.kode_pesanan',
                'pesanans.created_at',
                'pesanans.nama_tamu',

                DB::raw(
                    'GROUP_CONCAT(
                        pesanan_items.nama_item
                        SEPARATOR ", "
                    ) as nama_item'
                ),

                DB::raw(
                    'SUM(pesanan_items.jumlah) as jumlah'
                ),

                'pesanans.total'
            )

            ->when($this->tanggalMulai, function ($query) {

                $query->whereDate(
                    'pesanans.created_at',
                    '>=',
                    $this->tanggalMulai
                );

            })

            ->when($this->tanggalSelesai, function ($query) {

                $query->whereDate(
                    'pesanans.created_at',
                    '<=',
                    $this->tanggalSelesai
                );

            })

            ->groupBy(
                'pesanans.id',
                'pesanans.kode_pesanan',
                'pesanans.created_at',
                'pesanans.nama_tamu',
                'pesanans.total'
            )

            ->orderBy(
                'pesanans.created_at',
                'desc'
            );

        $data = $query->get();


        // =====================================================
        // TOTAL ITEM
        // =====================================================

        $itemQuery = DB::table('pesanans')
            ->join(
                'pesanan_items',
                'pesanans.id',
                '=',
                'pesanan_items.pesanan_id'
            );

        if ($this->tanggalMulai) {

            $itemQuery->whereDate(
                'pesanans.created_at',
                '>=',
                $this->tanggalMulai
            );
        }

        if ($this->tanggalSelesai) {

            $itemQuery->whereDate(
                'pesanans.created_at',
                '<=',
                $this->tanggalSelesai
            );
        }

        $totalItem = $itemQuery->sum(
            'pesanan_items.jumlah'
        );


        // =====================================================
        // TOTAL PENDAPATAN
        // =====================================================

        $summaryQuery = DB::table('pesanans');

        if ($this->tanggalMulai) {

            $summaryQuery->whereDate(
                'created_at',
                '>=',
                $this->tanggalMulai
            );
        }

        if ($this->tanggalSelesai) {

            $summaryQuery->whereDate(
                'created_at',
                '<=',
                $this->tanggalSelesai
            );
        }

        $totalPendapatan = $summaryQuery->sum('total');


        // =====================================================
        // PERIODE
        // =====================================================

        $periode = 'Semua Periode';

        if (
            $this->tanggalMulai &&
            $this->tanggalSelesai
        ) {

            $periode =
                date(
                    'd/m/Y',
                    strtotime($this->tanggalMulai)
                )
                . ' - ' .
                date(
                    'd/m/Y',
                    strtotime($this->tanggalSelesai)
                );

        } elseif ($this->tanggalMulai) {

            $periode =
                'Mulai ' .
                date(
                    'd/m/Y',
                    strtotime($this->tanggalMulai)
                );

        } elseif ($this->tanggalSelesai) {

            $periode =
                'Sampai ' .
                date(
                    'd/m/Y',
                    strtotime($this->tanggalSelesai)
                );
        }


        // =====================================================
        // SUSUN DATA
        // =====================================================

        $rows = [

            // BARIS 1 - JUDUL
            [
                'LAPORAN TRANSAKSI LAUNDRY'
            ],

            // BARIS 2 - PERIODE
            [
                'Periode: ' . $periode
            ],

            // BARIS 3 - SPASI
            // Dibuat isi kosong 6 kolom supaya Excel
            // benar-benar membuat satu baris kosong.
            [
                '',
                '',
                '',
                '',
                '',
                ''
            ],

            // BARIS 4 - HEADER TABEL
            [
                'Kode Pesanan',
                'Tanggal',
                'Nama Tamu',
                'Barang Laundry',
                'Jumlah',
                'Total'
            ],
        ];


        // =====================================================
        // DATA TRANSAKSI
        // =====================================================

        foreach ($data as $item) {

            $rows[] = [

                $item->kode_pesanan,

                date(
                    'd/m/Y',
                    strtotime($item->created_at)
                ),

                $item->nama_tamu ?? '-',

                $item->nama_item ?? '-',

                $item->jumlah ?? 0,

                $item->total ?? 0,

            ];
        }


        // =====================================================
        // SPASI SEBELUM TOTAL
        // =====================================================

        $rows[] = [
            '',
            '',
            '',
            '',
            '',
            ''
        ];


        // =====================================================
        // TOTAL AKHIR
        // =====================================================

        $rows[] = [

            '',
            '',
            '',

            'TOTAL',

            $totalItem,

            $totalPendapatan

        ];


        return $rows;
    }


    // =========================================================
    // STYLE DASAR
    // =========================================================

    public function styles(Worksheet $sheet)
    {
        return [

            // =================================================
            // JUDUL
            // =================================================

            1 => [

                'font' => [

                    'bold' => true,

                    'size' => 16,

                ],

                'alignment' => [

                    'horizontal' => 'center',

                    'vertical' => 'center',

                ],
            ],


            // =================================================
            // PERIODE
            // =================================================

            2 => [

                'font' => [

                    'bold' => false,

                    'italic' => true,

                    'size' => 11,

                ],

                'alignment' => [

                    'horizontal' => 'center',

                    'vertical' => 'center',

                ],
            ],


            // =================================================
            // HEADER TABEL
            // =================================================

            4 => [

                'font' => [

                    'bold' => false,

                    'size' => 11,

                ],

                'alignment' => [

                    'horizontal' => 'center',

                    'vertical' => 'center',

                ],
            ],
        ];
    }


    // =========================================================
    // FORMAT EXCEL
    // =========================================================

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();


                // =================================================
                // MERGE JUDUL
                // =================================================

                $sheet->mergeCells('A1:F1');


                // =================================================
                // MERGE PERIODE
                // =================================================

                $sheet->mergeCells('A2:F2');


                // =================================================
                // RESET FONT
                // =================================================

                $sheet->getStyle(
                    'A1:F' . $highestRow
                )
                    ->getFont()
                    ->setBold(false);


                // =================================================
                // JUDUL
                // =================================================

                $sheet->getStyle('A1:F1')
                    ->getFont()
                    ->setBold(true);

                $sheet->getStyle('A1:F1')
                    ->getFont()
                    ->setSize(16);


                // =================================================
                // PERIODE
                // =================================================

                $sheet->getStyle('A2:F2')
                    ->getFont()
                    ->setBold(false);

                $sheet->getStyle('A2:F2')
                    ->getFont()
                    ->setItalic(true);

                $sheet->getStyle('A2:F2')
                    ->getFont()
                    ->setSize(11);


                // =================================================
                // POSISI JUDUL
                // =================================================

                $sheet->getStyle('A1:F1')
                    ->getAlignment()
                    ->setHorizontal('center');

                $sheet->getStyle('A1:F1')
                    ->getAlignment()
                    ->setVertical('center');


                // =================================================
                // POSISI PERIODE
                // =================================================

                $sheet->getStyle('A2:F2')
                    ->getAlignment()
                    ->setHorizontal('center');

                $sheet->getStyle('A2:F2')
                    ->getAlignment()
                    ->setVertical('center');


                // =================================================
                // HEADER TABEL
                // =================================================

                $sheet->getStyle('A4:F4')
                    ->getFont()
                    ->setBold(false);

                $sheet->getStyle('A4:F4')
                    ->getAlignment()
                    ->setHorizontal('center');

                $sheet->getStyle('A4:F4')
                    ->getAlignment()
                    ->setVertical('center');


                // =================================================
                // DATA TRANSAKSI
                // =================================================

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'A5:F' . $highestRow
                    )
                        ->getFont()
                        ->setBold(false);
                }


                // =================================================
                // BORDER TABEL
                // =================================================
                // Mulai dari HEADER BARIS 4.
                // Jadi garis header juga ikut ada.

                $sheet->getStyle(
                    'A4:F' . $highestRow
                )
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        Border::BORDER_THIN
                    );


                // =================================================
                // RATA TENGAH DATA
                // =================================================

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'A5:C' . $highestRow
                    )
                        ->getAlignment()
                        ->setVertical('center');
                }


                // =================================================
                // BARANG LAUNDRY
                // =================================================
                // Dibuat rata kiri supaya daftar barang
                // lebih enak dibaca.

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'D5:D' . $highestRow
                    )
                        ->getAlignment()
                        ->setHorizontal('left');

                    $sheet->getStyle(
                        'D5:D' . $highestRow
                    )
                        ->getAlignment()
                        ->setVertical('center');

                    $sheet->getStyle(
                        'D5:D' . $highestRow
                    )
                        ->getAlignment()
                        ->setWrapText(true);
                }


                // =================================================
                // JUMLAH
                // =================================================

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'E5:E' . $highestRow
                    )
                        ->getAlignment()
                        ->setHorizontal('center');

                    $sheet->getStyle(
                        'E5:E' . $highestRow
                    )
                        ->getAlignment()
                        ->setVertical('center');
                }


                // =================================================
                // TOTAL / HARGA
                // =================================================

                if ($highestRow >= 5) {

                    $sheet->getStyle(
                        'F5:F' . $highestRow
                    )
                        ->getAlignment()
                        ->setHorizontal('right');

                    $sheet->getStyle(
                        'F5:F' . $highestRow
                    )
                        ->getAlignment()
                        ->setVertical('center');

                    $sheet->getStyle(
                        'F5:F' . $highestRow
                    )
                        ->getNumberFormat()
                        ->setFormatCode('#,##0');
                }


                // =================================================
                // TOTAL AKHIR BOLD
                // =================================================

                $sheet->getStyle(
                    'A' . $highestRow . ':F' . $highestRow
                )
                    ->getFont()
                    ->setBold(true);


                // =================================================
                // TOTAL AKHIR RATA TENGAH
                // =================================================

                $sheet->getStyle(
                    'D' . $highestRow . ':E' . $highestRow
                )
                    ->getAlignment()
                    ->setHorizontal('center');


                $sheet->getStyle(
                    'F' . $highestRow
                )
                    ->getAlignment()
                    ->setHorizontal('right');


                // =================================================
                // WRAP TEXT
                // =================================================

                $sheet->getStyle(
                    'A4:F' . $highestRow
                )
                    ->getAlignment()
                    ->setWrapText(true);


                // =================================================
                // TINGGI JUDUL
                // =================================================

                $sheet->getRowDimension(1)
                    ->setRowHeight(28);


                // =================================================
                // TINGGI PERIODE
                // =================================================

                $sheet->getRowDimension(2)
                    ->setRowHeight(20);


                // =================================================
                // SPASI ANTARA JUDUL DAN TABEL
                // =================================================

                $sheet->getRowDimension(3)
                    ->setRowHeight(14);


                // =================================================
                // TINGGI HEADER
                // =================================================

                $sheet->getRowDimension(4)
                    ->setRowHeight(24);


                // =================================================
                // LEBAR KOLOM
                // =================================================

                $sheet->getColumnDimension('A')
                    ->setWidth(18);


                $sheet->getColumnDimension('B')
                    ->setWidth(15);


                $sheet->getColumnDimension('C')
                    ->setWidth(20);


                // Barang Laundry dibuat lebih lebar
                $sheet->getColumnDimension('D')
                    ->setWidth(65);


                $sheet->getColumnDimension('E')
                    ->setWidth(12);


                $sheet->getColumnDimension('F')
                    ->setWidth(18);


                // =================================================
                // TINGGI BARIS DATA
                // =================================================

                for ($row = 5; $row < $highestRow; $row++) {

                    $sheet->getRowDimension($row)
                        ->setRowHeight(32);
                }


                // =================================================
                // BARIS TOTAL
                // =================================================

                $sheet->getRowDimension($highestRow)
                    ->setRowHeight(24);
            },
        ];
    }


    // =========================================================
    // NAMA SHEET
    // =========================================================

    public function title(): string
    {
        return 'Laporan Laundry';
    }
}