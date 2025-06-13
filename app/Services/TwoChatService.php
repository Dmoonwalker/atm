<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TwoChatService
{
    protected $apiKey;
    protected $bearerToken;
    protected $fromNumber;
    protected $baseUrl = 'https://api.p.2chat.io/open/whatsapp';

    public function __construct()
    {
        $this->apiKey = config('services.2chat.api_key');
        $this->bearerToken = config('services.2chat.bearer_token');
        $this->fromNumber = config('services.2chat.from_number');

        Log::info('TwoChatService initialized', [
            'from_number' => $this->fromNumber,
            'api_key_exists' => $this->apiKey,
            'bearer_token_exists' => !empty($this->bearerToken)
        ]);
    }

    public function getProducts($phoneNumber)
    {
        // Format phone number to international format
        $formattedPhone = $this->formatPhoneNumber($phoneNumber);

        $requestUrl = "{$this->baseUrl}/catalog/products/{$formattedPhone}?from_number={$this->fromNumber}";

        Log::info('2Chat API request details', [
            'target_number' => $phoneNumber,
            'formatted_number' => $formattedPhone,
            'from_number' => $this->fromNumber,
            'base_url' => $this->baseUrl,
            'full_request_url' => $requestUrl,
            'has_api_key' => !empty($this->apiKey),
            'has_bearer_token' => !empty($this->bearerToken),
            'headers' => [
                'X-User-API-Key' => substr($this->apiKey, 0, 10) . '...'
            ]
        ]);

        try {
            Log::info('Attempting HTTP request', [
                'url' => $requestUrl,
                'method' => 'GET',
                'headers' => [
                    'X-User-API-Key' => substr($this->apiKey, 0, 10) . '...'
                ]
            ]);

            $response = Http::withHeaders([
                "X-User-API-Key" => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
                ->timeout(30)
                ->retry(3, 100)
                ->withOptions([
                    'verify' => true,
                    'connect_timeout' => 30,
                    'read_timeout' => 30,
                    'timeout' => 30
                ])
                ->get($requestUrl);

            Log::info('HTTP request completed', [
                'status_code' => $response->status(),
                'is_successful' => $response->successful(),
                'has_body' => $response->body() ? true : false
            ]);

            $responseData = $response->json();

            Log::info('2Chat API raw response', [
                'request_url' => $requestUrl,
                'status_code' => $response->status(),
                'success' => $response->successful(),
                'response_body' => $responseData,
                'target_number' => $formattedPhone
            ]);

            if ($response->successful()) {
                Log::info('2Chat API data structure', [
                    'request_url' => $requestUrl,
                    'has_success_key' => isset($responseData['success']),
                    'has_products_key' => isset($responseData['products']),
                    'response_keys' => array_keys($responseData)
                ]);

                if (isset($responseData['success']) && $responseData['success']) {
                    $products = $responseData['products'] ?? [];
                    Log::info('2Chat API products found', [
                        'request_url' => $requestUrl,
                        'product_count' => count($products),
                        'first_product' => !empty($products) ? array_keys($products[0]) : []
                    ]);
                    return [
                        'success' => true,
                        'products' => $products
                    ];
                }

                Log::error('2Chat API returned unsuccessful response', [
                    'request_url' => $requestUrl,
                    'response' => $responseData,
                    'target_number' => $formattedPhone
                ]);
                return [
                    'success' => false,
                    'error' => 'API returned unsuccessful response',
                    'products' => []
                ];
            }

            Log::error('2Chat API request failed', [
                'request_url' => $requestUrl,
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'target_number' => $formattedPhone
            ]);
            return [
                'success' => false,
                'error' => 'API request failed with status: ' . $response->status(),
                'products' => []
            ];
        } catch (\Exception $e) {
            Log::error('2Chat API exception', [
                'request_url' => $requestUrl,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'target_number' => $formattedPhone,
                'exception_class' => get_class($e),
                'previous_exception' => $e->getPrevious() ? [
                    'message' => $e->getPrevious()->getMessage(),
                    'class' => get_class($e->getPrevious())
                ] : null
            ]);
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'products' => []
            ];
        }
    }

    /**
     * Format phone number to international format
     * 
     * @param string $phoneNumber
     * @return string
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // If number starts with 0, replace with +234
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '+234' . substr($phoneNumber, 1);
        }
        // If number doesn't start with +, add +234
        elseif (substr($phoneNumber, 0, 1) !== '+') {
            $phoneNumber = '+234' . $phoneNumber;
        }

        return $phoneNumber;
    }
}
