<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Snacks'],
            ['name' => 'Drinks'],
            ['name' => 'Local Dishes'],
            ['name' => 'Swallow'],
            ['name' => 'Accessories'],
            ['name' => 'Home Decor'],
            ['name' => 'Spices'],
            ['name' => 'Art'],
            ['name' => 'Phones'],
            ['name' => 'Clothing'],
        ];
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => $cat['description'] ?? null,
            ]);
        }
    }
}
