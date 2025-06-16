<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopLikeController extends Controller
{
    public function toggle(Shop $shop)
    {
        $user = Auth::user();
        $message = '';

        DB::transaction(function () use ($shop, $user, &$message) {
            if ($shop->likedBy($user)) {
                // Unlike
                $shop->likes()->where('user_id', $user->id)->delete();
                $message = 'Shop unliked successfully';
            } else {
                // Like
                $shop->likes()->create(['user_id' => $user->id]);
                $message = 'Shop liked successfully';
            }
        });

        // Update active status based on new likes count
        $shop->updateActiveStatus();

        return response()->json([
            'message' => $message,
            'likes_count' => $shop->likes_count,
            'is_liked' => $shop->likedBy($user),
            'is_active' => $shop->is_active
        ]);
    }

    public function check(Shop $shop)
    {
        $user = Auth::user();

        return response()->json([
            'is_liked' => $shop->likedBy($user),
            'likes_count' => $shop->likes_count,
            'is_active' => $shop->is_active
        ]);
    }
}
