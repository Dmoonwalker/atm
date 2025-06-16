<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        Log::info('Found users:', ['count' => $users->count()]);

        $categories = Category::all();
        $states = json_decode(file_get_contents(public_path('data/states.json')), true);

        foreach ($users as $user) {
            Log::info('Creating shops for user:', [
                'user_id' => $user->id,
                'user_id_type' => gettype($user->id),
                'user_email' => $user->email
            ]);

            // Create 2-3 shops per user
            $shopCount = rand(2, 3);

            for ($i = 0; $i < $shopCount; $i++) {
                $x = array_rand($states);
                $y = array_rand($states[$x]['lgas']);

                try {
                    $shop = Shop::create([
                        'name' => fake()->company(),
                        'description' => fake()->paragraph(),
                        'address' => fake()->streetAddress(),
                        'phone' => fake()->phoneNumber(),
                        'email' => fake()->companyEmail(),
                        'user_id' => $user->id,
                        'category_id' => $categories->random()->id,
                        'opening_time' => fake()->time('H:i'),
                        'closing_time' => fake()->time('H:i'),
                        'state' => $states[$x]['state'],
                        'local_government' => $states[$x]['lgas'][$y],
                        'is_active' => false,
                    ]);

                    Log::info('Created shop:', [
                        'shop_id' => $shop->id,
                        'user_id' => $shop->user_id,
                        'user_id_type' => gettype($shop->user_id)
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to create shop:', [
                        'error' => $e->getMessage(),
                        'user_id' => $user->id,
                        'user_id_type' => gettype($user->id)
                    ]);
                }
            }
        }
    }
}
