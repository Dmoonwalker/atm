<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DefaultCategorySeeder extends Seeder
{
    public function run()
    {
        Category::firstOrCreate(
            ['name' => 'Imported Products'],
            [
                'description' => 'Products imported from external sources',
                'slug' => 'imported-products'
            ]
        );
    }
}
 