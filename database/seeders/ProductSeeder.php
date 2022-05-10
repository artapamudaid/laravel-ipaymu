<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'name' => 'Tas Hermes',
                'description' => 'Ini tas li;ot',
                'price' => 65000000
            ],
            [
                'name' => 'Nike Air Jordan',
                'description' => 'Ini sepatu olahraga',
                'price' => 15000000
            ],
            [
                'name' => 'Kemeja Alissan',
                'description' => 'Ini kemeja formal',
                'price' => 120000
            ],
        ];

        Product::insert($products);
    }
}
