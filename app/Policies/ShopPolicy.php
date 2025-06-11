<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }

    public function update(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }

    public function delete(User $user, Shop $shop)
    {
        return $user->id === $shop->user_id;
    }
}
