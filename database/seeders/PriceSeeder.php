<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['art_no' => 1, 'nama_item' => 'Laundry Shirt / Kemeja (L)', 'kategori' => 'Gentlemen', 'harga' => 10000],
            ['art_no' => 2, 'nama_item' => 'Laundry T-Shirt / Kaos (L)', 'kategori' => 'Gentlemen', 'harga' => 8000],
            ['art_no' => 3, 'nama_item' => 'Laundry Trouser / Celana Panjang (L)', 'kategori' => 'Gentlemen', 'harga' => 10000],
            ['art_no' => 4, 'nama_item' => 'Laundry Short / Celana Pendek (L)', 'kategori' => 'Gentlemen', 'harga' => 7000],
            ['art_no' => 5, 'nama_item' => 'Laundry Pajamas Piyama (L)', 'kategori' => 'Gentlemen', 'harga' => 12000],
            ['art_no' => 6, 'nama_item' => 'Laundry Sweater / Baju Dingin (L)', 'kategori' => 'Gentlemen', 'harga' => 15000],
            ['art_no' => 7, 'nama_item' => 'Laundry Under Shirt / Kaos Dalam (L)', 'kategori' => 'Gentlemen', 'harga' => 5000],
            ['art_no' => 8, 'nama_item' => 'Laundry Under Short / Celana Dalam (L)', 'kategori' => 'Gentlemen', 'harga' => 5000],
            ['art_no' => 9, 'nama_item' => 'Laundry Handkerchief / Saputangan (L)', 'kategori' => 'Gentlemen', 'harga' => 3000],
            ['art_no' => 10, 'nama_item' => 'Laundry Sock / Kaos Kaki (L)', 'kategori' => 'Gentlemen', 'harga' => 4000],
            ['art_no' => 11, 'nama_item' => 'Laundry Sarung (L)', 'kategori' => 'Gentlemen', 'harga' => 8000],
            ['art_no' => 12, 'nama_item' => 'Laundry Batik Shirt / Baju Batik (L)', 'kategori' => 'Gentlemen', 'harga' => 12000],
            ['art_no' => 17, 'nama_item' => 'Laundry Mangset', 'kategori' => 'Gentlemen', 'harga' => 5000],
            ['art_no' => 43, 'nama_item' => 'Laundry Jacket', 'kategori' => 'Gentlemen', 'harga' => 18000],
            ['art_no' => 13, 'nama_item' => 'Laundry Bath Towel / Handuk Mandi', 'kategori' => 'Handuk/Linen', 'harga' => 12000],
            ['art_no' => 14, 'nama_item' => 'Laundry Hand Towel / Handuk Tangan', 'kategori' => 'Handuk/Linen', 'harga' => 10000],
            ['art_no' => 15, 'nama_item' => 'Paket Laundry 75', 'kategori' => 'Paket', 'harga' => 75000],
            ['art_no' => 16, 'nama_item' => 'Paket Laundry 55', 'kategori' => 'Paket', 'harga' => 55000],
            ['art_no' => 47, 'nama_item' => 'Paket Laundry 50', 'kategori' => 'Paket', 'harga' => 50000],
            ['art_no' => 18, 'nama_item' => 'Laundry Express Jaket/Jas', 'kategori' => 'Express', 'harga' => 25000],
            ['art_no' => 19, 'nama_item' => 'Laundry Express Suit (2pcs) Jas', 'kategori' => 'Express', 'harga' => 35000],
            ['art_no' => 20, 'nama_item' => 'Laundry Express Safari (2pcs)', 'kategori' => 'Express', 'harga' => 35000],
            ['art_no' => 21, 'nama_item' => 'Laundry Express Pressing Shirt', 'kategori' => 'Express', 'harga' => 15000],
            ['art_no' => 22, 'nama_item' => 'Laundry Express Pressing T-Shirt', 'kategori' => 'Express', 'harga' => 12000],
            ['art_no' => 23, 'nama_item' => 'Laundry Express Celana Panjang', 'kategori' => 'Express', 'harga' => 15000],
            ['art_no' => 24, 'nama_item' => 'Laundry Express Celana Pendek', 'kategori' => 'Express', 'harga' => 10000],
            ['art_no' => 25, 'nama_item' => 'Laundry Express Rompi', 'kategori' => 'Express', 'harga' => 12000],
            ['art_no' => 26, 'nama_item' => 'Laundry Express Sweater / Baju Dingin', 'kategori' => 'Express', 'harga' => 20000],
            ['art_no' => 27, 'nama_item' => 'Laundry Express Sarung', 'kategori' => 'Express', 'harga' => 12000],
            ['art_no' => 28, 'nama_item' => 'Laundry Express Batik', 'kategori' => 'Express', 'harga' => 18000],
            ['art_no' => 31, 'nama_item' => 'Pressing Suit 2pcs Jas (L)', 'kategori' => 'Pressing', 'harga' => 20000],
            ['art_no' => 32, 'nama_item' => 'Pressing Safari 2 Jas Safari (L)', 'kategori' => 'Pressing', 'harga' => 20000],
            ['art_no' => 33, 'nama_item' => 'Pressing Jacket (L)', 'kategori' => 'Pressing', 'harga' => 12000],
            ['art_no' => 34, 'nama_item' => 'Pressing Shirt / Kemeja (L)', 'kategori' => 'Pressing', 'harga' => 6000],
            ['art_no' => 35, 'nama_item' => 'Pressing T-Shirt / Kaos (L)', 'kategori' => 'Pressing', 'harga' => 5000],
            ['art_no' => 36, 'nama_item' => 'Pressing Trouser / Celana Panjang (L)', 'kategori' => 'Pressing', 'harga' => 6000],
            ['art_no' => 37, 'nama_item' => 'Pressing Short / Celana Pendek (L)', 'kategori' => 'Pressing', 'harga' => 4000],
            ['art_no' => 38, 'nama_item' => 'Pressing Vest / Rompi (L)', 'kategori' => 'Pressing', 'harga' => 6000],
            ['art_no' => 39, 'nama_item' => 'Pressing Sweater / Baju Dingin (L)', 'kategori' => 'Pressing', 'harga' => 8000],
            ['art_no' => 40, 'nama_item' => 'Pressing Sarung (L)', 'kategori' => 'Pressing', 'harga' => 5000],
            ['art_no' => 41, 'nama_item' => 'Pressing Batik Shirt (L)', 'kategori' => 'Pressing', 'harga' => 7000],
            ['art_no' => 42, 'nama_item' => 'Pressing Tie / Dasi (L)', 'kategori' => 'Pressing', 'harga' => 3000],
            ['art_no' => 45, 'nama_item' => 'Ciput', 'kategori' => 'Ladies', 'harga' => 3000],
            ['art_no' => 46, 'nama_item' => 'Gamis / Jubah', 'kategori' => 'Ladies', 'harga' => 18000],
            ['art_no' => 60, 'nama_item' => 'Mukena', 'kategori' => 'Ladies', 'harga' => 15000],
            ['art_no' => 61, 'nama_item' => 'Laundry Dress / Gaun (W)', 'kategori' => 'Ladies', 'harga' => 20000],
            ['art_no' => 62, 'nama_item' => 'Laundry T-Shirt (W)', 'kategori' => 'Ladies', 'harga' => 8000],
            ['art_no' => 63, 'nama_item' => 'Laundry Pakaian Wanita (W)', 'kategori' => 'Ladies', 'harga' => 10000],
            ['art_no' => 64, 'nama_item' => 'Laundry Rok Pendek (W)', 'kategori' => 'Ladies', 'harga' => 8000],
            ['art_no' => 65, 'nama_item' => 'Laundry Night Gown / Baju Tidur (W)', 'kategori' => 'Ladies', 'harga' => 12000],
            ['art_no' => 66, 'nama_item' => 'Laundry Kimono / Baju Mandi', 'kategori' => 'Ladies', 'harga' => 15000],
            ['art_no' => 67, 'nama_item' => 'Laundry Scraft / Selendang (W)', 'kategori' => 'Ladies', 'harga' => 5000],
            ['art_no' => 68, 'nama_item' => 'Laundry Brassieres / BH (W)', 'kategori' => 'Ladies', 'harga' => 4000],
            ['art_no' => 69, 'nama_item' => 'Laundry Panties / Celana Dalam (W)', 'kategori' => 'Ladies', 'harga' => 4000],
            ['art_no' => 70, 'nama_item' => 'Laundry Swimsuit / Baju Renang', 'kategori' => 'Ladies', 'harga' => 10000],
            ['art_no' => 71, 'nama_item' => 'Laundry Moslem Suit / Baju Muslim', 'kategori' => 'Ladies', 'harga' => 18000],
            ['art_no' => 72, 'nama_item' => 'Laundry Jilbab (W)', 'kategori' => 'Ladies', 'harga' => 6000],
            ['art_no' => 44, 'nama_item' => 'Laundry ChildCloth / Baju Anak', 'kategori' => 'Anak', 'harga' => 6000],
            ['art_no' => 73, 'nama_item' => 'Laundry Hat / Topi / Sport Shorts', 'kategori' => 'Umum', 'harga' => 6000],
            ['art_no' => 74, 'nama_item' => 'Laundry Panties Anak', 'kategori' => 'Anak', 'harga' => 3000],
            ['art_no' => 91, 'nama_item' => 'Pressing Lady 2Pcs Jas (W)', 'kategori' => 'Pressing', 'harga' => 20000],
            ['art_no' => 92, 'nama_item' => 'Pressing Blazer Jas Wanita (W)', 'kategori' => 'Pressing', 'harga' => 15000],
            ['art_no' => 93, 'nama_item' => 'Pressing Dress / Gaun (W)', 'kategori' => 'Pressing', 'harga' => 12000],
            ['art_no' => 94, 'nama_item' => 'Pressing T-Shirt (W)', 'kategori' => 'Pressing', 'harga' => 5000],
            ['art_no' => 95, 'nama_item' => 'Pressing Blouse / Pakaian Wanita (W)', 'kategori' => 'Pressing', 'harga' => 6000],
        ];

        foreach ($items as $item) {
            unset($item['art_no']);
            Price::create($item);
        }
    }
}