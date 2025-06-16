<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopLikesSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = range(4, 10); // User IDs 4-10
        $shopIds = range(1, 3);  // Shop IDs 1-3

        foreach ($shopIds as $shopId) {
            foreach ($userIds as $userId) {
                DB::table('shop_likes')->insertOrIgnore([
                    'shop_id' => $shopId,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
