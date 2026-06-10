<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // --- Kategori 1: Elektronik Bekas ---
            [
                'name'        => 'Magic Com Yong Ma Bekas',
                'category_id' => 1,
                'price'       => 120000,
                'condition'   => 'Baik',
                'description' => 'Magic Com Yong Ma bekas pemakaian 1 tahun. Kondisi pemanas masih berfungsi normal 100%, panci dalam teflon ada goresan halus tipis.',
            ],
            [
                'name'        => 'Setrika Philips Klasik HD1173',
                'category_id' => 1,
                'price'       => 95000,
                'condition'   => 'Sangat Baik',
                'description' => 'Setrika Philips tipe klasik legendaris, kondisi bodi mulus dan panasnya sangat merata stabil. Kabel orisinil aman terawat.',
            ],
            [
                'name'        => 'Kipas Angin Meja Maspion 9 Inch',
                'category_id' => 1,
                'price'       => 75000,
                'condition'   => 'Baik',
                'description' => 'Kipas angin meja kecil merk Maspion 9 inch. Putaran kencang, tidak bising, tombol kecepatan 1 & 2 normal.',
            ],
            [
                'name'        => 'Blender Miyako 2-in-1',
                'category_id' => 1,
                'price'       => 110000,
                'condition'   => 'Cukup',
                'description' => 'Blender Miyako lengkap dengan gelas besar dan dry mill bumbu. Mesin lancar, pisau agak sedikit tumpul tapi masih bisa menghaluskan dengan baik.',
            ],
            [
                'name'        => 'Rice Cooker Cosmos Harmond 1.8L',
                'category_id' => 1,
                'price'       => 150000,
                'condition'   => 'Baik',
                'description' => 'Rice cooker Cosmos panci anti gores Harmond. Fungsi masak dan menghangatkan bekerja normal, kelengkapan cup ukur & centong nasi.',
            ],
            [
                'name'        => 'Dispenser Air Miyako Hot & Normal',
                'category_id' => 1,
                'price'       => 85000,
                'condition'   => 'Cukup',
                'description' => 'Dispenser Miyako fungsi panas dan normal. Kran air normal tidak bocor, body luar ada sedikit menguning karena pemakaian wajar.',
            ],

            // --- Kategori 2: Peralatan Rumah Tangga ---
            [
                'name'        => 'Ember Plastik Hijau Tebal 20 Liter',
                'category_id' => 2,
                'price'       => 15000,
                'condition'   => 'Baik',
                'description' => 'Ember plastik warna hijau kapasitas 20 liter. Bahan tebal tidak mudah pecah, gagang besi kokoh tanpa karat.',
            ],
            [
                'name'        => 'Baskom Plastik Besar Serbaguna',
                'category_id' => 2,
                'price'       => 10000,
                'condition'   => 'Baik',
                'description' => 'Baskom plastik diameter 40 cm. Bagus untuk mencuci pakaian atau wadah air besar, tidak bocor.',
            ],
            [
                'name'        => 'Rak Plastik Susun 3 Multiguna',
                'category_id' => 2,
                'price'       => 28000,
                'condition'   => 'Cukup',
                'description' => 'Rak plastik susun 3 untuk bumbu dapur atau perlengkapan kamar mandi. Sedikit kusam wajar tapi struktur masih tegak kokoh.',
            ],
            [
                'name'        => 'Kursi Plastik Napolly Hijau',
                'category_id' => 2,
                'price'       => 35000,
                'condition'   => 'Baik',
                'description' => 'Kursi plastik merk Napolly tanpa sandaran. Plastik tebal berkualitas, mampu menahan beban hingga 90kg dengan aman.',
            ],

            // --- Kategori 3: Otomotif ---
            [
                'name'        => 'Helm Honda TRX-3 Halfface',
                'category_id' => 3,
                'price'       => 50000,
                'condition'   => 'Cukup',
                'description' => 'Helm bawaan motor Honda TRX-3. Kaca pelindung ada baret halus tipis tapi tidak mengganggu pandangan, busa bagian dalam masih lumayan tebal.',
            ],
            [
                'name'        => 'Spion Honda Beat Karbu Sepasang',
                'category_id' => 3,
                'price'       => 25000,
                'condition'   => 'Sangat Baik',
                'description' => 'Spion original lepasan dari motor Honda Beat. Kaca bening jernih, drat baut 14 mulus tidak dol, tinggal pasang.',
            ],
            [
                'name'        => 'Jas Hujan Tiger Head Setelan',
                'category_id' => 3,
                'price'       => 45000,
                'condition'   => 'Cukup',
                'description' => 'Jas hujan setelan baju celana merk Tiger Head. Bahan PVC tebal, ada sedikit rembes tipis di area jahitan selangkangan celana, jaket masih 100% aman.',
            ],

            // --- Kategori 4: Perabot Rumah ---
            [
                'name'        => 'Meja Belajar Lipat Anak Kayu',
                'category_id' => 4,
                'price'       => 30000,
                'condition'   => 'Baik',
                'description' => 'Meja belajar lipat bahan kayu MDF dengan karakter kartun. Kaki meja dari besi kuat, mudah disimpan dan hemat tempat.',
            ],
            [
                'name'        => 'Lemari Pakaian Plastik 3 Susun',
                'category_id' => 4,
                'price'       => 140000,
                'condition'   => 'Sangat Baik',
                'description' => 'Lemari plastik susun 3 merk Club. Kondisi mulus, laci lancar dibuka tutup, tidak ada pecah, warna abu-abu minimalis.',
            ],
            [
                'name'        => 'Rak Buku Kayu Minimalis 4 Kolom',
                'category_id' => 4,
                'price'       => 65000,
                'condition'   => 'Baik',
                'description' => 'Rak buku / rak serbaguna bahan particle board. Ukuran kompak cocok di sudut kamar kos untuk merapikan buku pelajaran.',
            ],

            // --- Kategori 5: Lainnya ---
            [
                'name'        => 'Mainan Mobil Remote Control (RC)',
                'category_id' => 5,
                'price'       => 40000,
                'condition'   => 'Rusak Ringan',
                'description' => 'Mainan mobil remote control skala 1:20. Body mulus, remote menyala, tapi roda depan kadang macet saat berbelok kiri. Perlu diservis sedikit.',
            ],
            [
                'name'        => 'Buku Kamus Lengkap Inggris-Indonesia',
                'category_id' => 5,
                'price'       => 20000,
                'condition'   => 'Sangat Baik',
                'description' => 'Kamus Bahasa Inggris-Indonesia Indonesia-Inggris John M. Echols & Hassan Shadily. Kertas masih bersih, tidak ada coretan, sampul plastik terawat.',
            ],
            [
                'name'        => 'Tas Ransel Eiger Outpost Bekas',
                'category_id' => 5,
                'price'       => 180000,
                'condition'   => 'Baik',
                'description' => 'Tas punggung ransel merk Eiger kapasitas 25L. Semua ritsleting berfungsi mulus lancar, warna agak sedikit pudar wajar pemakaian outdoor.',
            ],
            [
                'name'        => 'Sepatu Sneakers Vans Old Skool Hitam',
                'category_id' => 5,
                'price'       => 220000,
                'condition'   => 'Cukup',
                'description' => 'Sepatu Vans Old Skool hitam putih size 41. Kondisi sol luar ada aus di bagian tumit belakang wajar, kanvas masih utuh no robek.',
            ]
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'user_id'     => 2, // penjual@gmail.com
                'category_id' => $product['category_id'],
                'name'        => $product['name'],
                'slug'        => Str::slug($product['name']),
                'description' => $product['description'],
                'price'       => $product['price'],
                'stock'       => $product['stock'] ?? 5,
                'condition'   => $product['condition'],
                'status'      => 'aktif',
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}