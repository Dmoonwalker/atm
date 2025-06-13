<?php

namespace App\Http\Controllers;

use App\Services\TwoChatService;
use Illuminate\Http\Request;

class TwoChatController extends Controller
{
    protected $twoChatService;

    public function __construct(TwoChatService $twoChatService)
    {
        $this->twoChatService = $twoChatService;
    }

    public function getProducts(Request $request)
    {
        $request->validate([
            'target_number' => 'required|string',
        ]);

        $result = $this->twoChatService->getProducts($request->target_number);

        if (!$result['success']) {
            return response()->json($result, 400);
        }

        return response()->json($result);
    }
}
