<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Featured shops: top 4 active shops, ordered by most recently created
        $featuredShops = Shop::where('is_active', true)->latest()->take(4)->get();
        // User's own shops
        $myShops = Shop::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', [
            'featuredShops' => $featuredShops,
            'myShops' => $myShops,
        ]);
    }
}
