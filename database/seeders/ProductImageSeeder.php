<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $urls = [
            1  => 'images/yongma.png', // Magic Com Yong Ma
            2  => 'images/setrika.png', // Setrika Philips
            3  => 'images/kipas.png', // Kipas Angin Maspion
            4  => 'images/blender.png', // Blender Miyako
            5  => 'images/cosmos.png', // Rice Cooker Cosmos
            6  => 'images/dispenser.png', // Dispenser Air Miyako
            7  => 'images/ember.png', // Ember Plastik
            8  => 'images/baskom.png', // Baskom Plastik
            9  => 'images/rak.png', // Rak Plastik Susun
            10 => 'images/kursi_napolly.png', // Kursi Plastik Napolly
            11 => 'images/helm.png', // Helm Honda
            12 => 'images/spion.png', // Spion Honda
            13 => 'images/jashujan.png', // Jas Hujan Tiger Head
            14 => 'images/meja.png', // Meja Belajar Lipat
            15 => 'images/lemari.png', // Lemari Pakaian Plastik
            16 => 'images/rakbuku.png', // Rak Buku Kayu
            17 => 'images/mainan.png', // Mainan Mobil RC
            18 => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=600', // Buku Kamus Lengkap
            19 => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&q=80&w=600', // Tas Ransel Eiger
            20 => 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?auto=format&fit=crop&q=80&w=600', // Sepatu Sneakers Vans
        ];

        foreach ($urls as $productId => $url) {
            DB::table('product_images')->insert([
                'product_id' => $productId,
                'image_url'  => $url,
                'is_primary' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
