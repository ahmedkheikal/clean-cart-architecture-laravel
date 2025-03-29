<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Infrastructure\Persistance\Models\Product;
use App\Infrastructure\Persistance\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        
        // Create default categories if they don't exist
        $categories = [
            'Electronics',
            'Clothing',
            'Books',
            'Home & Garden',
            'Sports & Outdoors'
        ];
        
        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $categoryIds[] = $category->id;
        }
        
        // Create 50 products
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->words(3, true),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 10, 1000),
                'image' => $faker->imageUrl(640, 480, 'products', true),
                'category_id' => $faker->randomElement($categoryIds),
                'stock_balance' => $faker->numberBetween(0, 100),
            ]);
        }
    }
} 