<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\TwoChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    protected $twoChatService;

    public function __construct(TwoChatService $twoChatService)
    {
        $this->twoChatService = $twoChatService;
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'shop_id' => 'required|exists:shops,id'
            ]);

            $user = $request->user();
            $shop = Shop::findOrFail($request->shop_id);

            // Get products and import them directly using user's phone number
            $result = $user->importProductsFromTwoChat($shop);

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Failed to import WhatsApp products', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to import products: ' . $e->getMessage()
            ]);
        }
    }
}
