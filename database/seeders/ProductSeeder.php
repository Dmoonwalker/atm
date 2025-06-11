<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Lagos Fresh Foods Products
            [
                'name' => 'Fresh Tomatoes',
                'description' => 'Farm-fresh tomatoes from Oyo State',
                'price' => 2500.00,
                'stock_quantity' => 100,
                'category' => 'Vegetables',
                'shop_id' => 1,
            ],
            [
                'name' => 'Green Plantain',
                'description' => 'Fresh green plantain, perfect for cooking',
                'price' => 1500.00,
                'stock_quantity' => 50,
                'category' => 'Fruits',
                'shop_id' => 1,
            ],
            [
                'name' => 'Fresh Spinach',
                'description' => 'Organic spinach leaves',
                'price' => 800.00,
                'stock_quantity' => 75,
                'category' => 'Vegetables',
                'shop_id' => 1,
            ],

            // Abuja Fashion Hub Products
            [
                'name' => 'Ankara Dress',
                'description' => 'Beautiful handcrafted Ankara dress',
                'price' => 25000.00,
                'stock_quantity' => 10,
                'category' => 'Clothing',
                'shop_id' => 2,
            ],
            [
                'name' => 'Beaded Necklace',
                'description' => 'Traditional Nigerian beaded necklace',
                'price' => 5000.00,
                'stock_quantity' => 20,
                'category' => 'Accessories',
                'shop_id' => 2,
            ],
            [
                'name' => 'Aso Oke Head Tie',
                'description' => 'Premium Aso Oke head tie',
                'price' => 15000.00,
                'stock_quantity' => 15,
                'category' => 'Accessories',
                'shop_id' => 2,
            ],

            // Port Harcourt Tech Store Products
            [
                'name' => 'Samsung Galaxy A54',
                'description' => 'Latest Samsung smartphone with 5G',
                'price' => 250000.00,
                'stock_quantity' => 5,
                'category' => 'Phones',
                'shop_id' => 3,
            ],
            [
                'name' => 'Power Bank 20000mAh',
                'description' => 'High capacity power bank with fast charging',
                'price' => 15000.00,
                'stock_quantity' => 25,
                'category' => 'Accessories',
                'shop_id' => 3,
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'Noise cancelling wireless earbuds',
                'price' => 25000.00,
                'stock_quantity' => 30,
                'category' => 'Accessories',
                'shop_id' => 3,
            ],

            // Kano Spices Market Products
            [
                'name' => 'Suya Spice Mix',
                'description' => 'Authentic Nigerian suya spice blend',
                'price' => 2000.00,
                'stock_quantity' => 50,
                'category' => 'Spices',
                'shop_id' => 4,
            ],
            [
                'name' => 'Yaji Powder',
                'description' => 'Traditional Hausa pepper mix',
                'price' => 1500.00,
                'stock_quantity' => 40,
                'category' => 'Spices',
                'shop_id' => 4,
            ],
            [
                'name' => 'Curry Powder',
                'description' => 'Premium Nigerian curry powder',
                'price' => 1000.00,
                'stock_quantity' => 60,
                'category' => 'Spices',
                'shop_id' => 4,
            ],

            // Ibadan Home Decor Products
            [
                'name' => 'Adire Cushion Covers',
                'description' => 'Hand-dyed Adire fabric cushion covers',
                'price' => 8000.00,
                'stock_quantity' => 20,
                'category' => 'Home Decor',
                'shop_id' => 5,
            ],
            [
                'name' => 'Wooden Carving',
                'description' => 'Traditional Yoruba wooden carving',
                'price' => 15000.00,
                'stock_quantity' => 8,
                'category' => 'Art',
                'shop_id' => 5,
            ],
            [
                'name' => 'Batik Table Runner',
                'description' => 'Handmade batik table runner',
                'price' => 5000.00,
                'stock_quantity' => 15,
                'category' => 'Home Decor',
                'shop_id' => 5,
            ],
        ];

        $categoryIds = \App\Models\Category::pluck('id')->all();
        foreach ($products as $product) {
            $category_id = collect($categoryIds)->random();
            $productData = $product;
            unset($productData['category']);
            $productData['category_id'] = $category_id;
            Product::create($productData);
        }
    }
}
