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
        Log::info('Starting ShopSeeder', [
            'total_users' => $users->count(),
            'users' => $users->pluck('id', 'email')->toArray()
        ]);

        if ($users->isEmpty()) {
            Log::error('No users found in ShopSeeder');
            return;
        }

        $categories = Category::all();
        Log::info('Categories found', [
            'total_categories' => $categories->count(),
            'categories' => $categories->pluck('id', 'name')->toArray()
        ]);

        if ($categories->isEmpty()) {
            Log::error('No categories found in ShopSeeder');
            return;
        }

        $states = json_decode(file_get_contents(public_path('data/states.json')), true);
        Log::info('States loaded', [
            'total_states' => count($states)
        ]);

        foreach ($users as $user) {
            Log::info('Creating shops for user:', [
                'user_id' => $user->id,
                'user_email' => $user->email
            ]);

            // Create 2-3 shops per user
            $shopCount = rand(2, 3);

            for ($i = 0; $i < $shopCount; $i++) {
                $x = array_rand($states);
                $y = array_rand($states[$x]['lgas']);

                try {
                    $shopData = [
                        'name' => fake()->company(),
                        'description' => fake()->paragraph(),
                        'address' => fake()->streetAddress(),
                        'user_id' => $user->id,
                        'category_id' => $categories->random()->id,
                        'opening_time' => fake()->time('H:i'),
                        'closing_time' => fake()->time('H:i'),
                        'state' => $states[$x]['state'],
                        'local_government' => $states[$x]['lgas'][$y],
                        'is_active' => false,
                    ];

                    Log::info('Attempting to create shop with data:', $shopData);

                    $shop = Shop::create($shopData);

                    Log::info('Successfully created shop:', [
                        'shop_id' => $shop->id,
                        'shop_name' => $shop->name,
                        'user_id' => $shop->user_id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to create shop:', [
                        'error' => $e->getMessage(),
                        'error_trace' => $e->getTraceAsString(),
                        'user_id' => $user->id,
                        'attempt' => $i + 1
                    ]);
                }
            }
        }

        // Verify shops were created
        $totalShops = Shop::count();
        Log::info('ShopSeeder completed', [
            'total_shops_created' => $totalShops
        ]);
    }
}
