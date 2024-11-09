<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(1)->create();

        foreach ($products as $product) {
            Image::factory(3)->create([
                'imageable_id' => $product->id,
                'imageable_type' => Product::class
            ]);
        }
    }
}
