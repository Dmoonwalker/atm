<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = Category::all();
        $states = json_decode(file_get_contents(public_path('data/states.json')), true);

        foreach ($users as $user) {
            // Create 2-3 shops per user
            $shopCount = rand(2, 3);

            for ($i = 0; $i < $shopCount; $i++) {
                $x = array_rand($states);
                $y = array_rand($states[$x]['lgas']);

                Shop::create([
                    'name' => fake()->company(),
                    'description' => fake()->paragraph(),
                    'address' => fake()->streetAddress(),
                    'phone' => fake()->phoneNumber(),
                    'email' => fake()->companyEmail(),
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id,
                    'likes' => rand(0, 10),
                    'opening_time' => fake()->time('H:i'),
                    'closing_time' => fake()->time('H:i'),
                    'state' => $states[$x]['state'],
                    'local_government' => $states[$x]['lgas'][$y],
                    'is_active' => false,
                ]);
            }
        }
    }
}
