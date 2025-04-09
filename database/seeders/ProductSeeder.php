<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'nama' => 'Laptop',
                'deskripsi' => 'Laptop dengan ukuran 15.6"',
                'harga' => 100000,
                'stok' => 100,
            ],
            [
                'nama' => 'Komputer',
                'deskripsi' => 'Komputer dengan ukuran 15.6"',
                'harga' => 100000,
                'stok' => 100,
            ],
            [
                'nama' => 'Tablet',
                'deskripsi' => 'Tablet dengan ukuran 15.6"',
                'harga' => 100000,
                'stok' => 100,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
