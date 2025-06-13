<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Shop;
use App\Services\TwoChatService;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'state',
        'local_government',
        'profile_photo',
        'bio',
        'preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'preferences' => 'array',
        ];
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function importProductsFromTwoChat($shop)
    {
        try {
            Log::info('Starting product import from 2Chat', [
                'user_id' => $this->id,
                'shop_id' => $shop->id,
                'shop_name' => $shop->name
            ]);

            // 1. Get products from 2Chat
            $twoChatService = app(TwoChatService::class);
            $result = $twoChatService->getProducts($this->phone);

            if (!$result['success']) {
                Log::error('2Chat API Error', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'error' => $result['error'] ?? 'Unknown error'
                ]);
                return [
                    'success' => false,
                    'error' => $result['error'] ?? 'Failed to fetch products'
                ];
            }

            if (empty($result['products'])) {
                Log::warning('No products found to import', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'phone' => $this->phone
                ]);
                return [
                    'success' => false,
                    'error' => 'No products found to import'
                ];
            }

            // 2. Parse and save products to the specified shop
            return $this->parseAndSaveProducts($result['products'], $shop);
        } catch (\Exception $e) {
            Log::error('Product import failed', [
                'user_id' => $this->id,
                'shop_id' => $shop->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => 'Failed to import products: ' . $e->getMessage()
            ];
        }
    }

    private function parseAndSaveProducts($products, $shop)
    {
        $importedCount = 0;
        $errors = [];

        // Get the default category for imported products
        $defaultCategory = Category::where('name', 'Imported Products')->first();
        if (!$defaultCategory) {
            Log::error('2Chat Import Error: Default category not found', [
                'user_id' => $this->id,
                'shop_id' => $shop->id
            ]);
            return [
                'success' => false,
                'error' => 'Default category not found. Please run the DefaultCategorySeeder.'
            ];
        }

        foreach ($products as $product) {
            try {
                Log::info('Processing product', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'product_id' => $product['id'] ?? 'unknown',
                    'product_name' => $product['name'] ?? 'unknown'
                ]);

                $parsedProduct = $this->parseProductData($product, $defaultCategory->id, $shop);
                $this->saveProduct($parsedProduct);
                $importedCount++;

                Log::info('Product created successfully', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'product_id' => $product['id'] ?? 'unknown'
                ]);
            } catch (\Exception $e) {
                Log::error('2Chat Product Import Error', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'product_id' => $product['id'] ?? 'unknown',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                $errors[] = "Failed to import product {$product['name']}: {$e->getMessage()}";
            }
        }

        Log::info('2Chat Import Complete', [
            'user_id' => $this->id,
            'shop_id' => $shop->id,
            'imported_count' => $importedCount,
            'error_count' => count($errors)
        ]);

        return [
            'success' => true,
            'imported_count' => $importedCount,
            'errors' => $errors
        ];
    }

    private function parseProductData($product, $categoryId, $shop)
    {
        $imageUrl = null;
        if (!empty($product['images'])) {
            try {
                $imageUrl = $this->downloadAndSaveImage($product['images'][0]['url']);
            } catch (\Exception $e) {
                Log::error('Failed to download product image', [
                    'user_id' => $this->id,
                    'shop_id' => $shop->id,
                    'product_id' => $product['id'] ?? 'unknown',
                    'image_url' => $product['images'][0]['url'] ?? 'unknown',
                    'error' => $e->getMessage()
                ]);
            }
        }

        return [
            'user_id' => $this->id,
            'shop_id' => $shop->id,
            'category_id' => $categoryId,
            'name' => $product['name'] ?? '',
            'description' => $product['description'] ?? '',
            'price' => $product['price'] ?? 0,
            'currency' => $product['currency'] ?? 'NGN',
            'availability' => $product['availability'] ?? 'in_stock',
            'image_url' => $imageUrl,
            'source' => '2chat',
            'twochat_id' => $product['id'] ?? null
        ];
    }

    private function downloadAndSaveImage($imageUrl)
    {
        $maxAttempts = 2;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            try {
                $attempt++;
                Log::info('Attempting to download product image', [
                    'user_id' => $this->id,
                    'image_url' => $imageUrl,
                    'attempt' => $attempt
                ]);

                // Use Laravel's HTTP client with better configuration
                $response = Http::withHeaders([
                    'Accept' => '*/*',
                    'Accept-Encoding' => 'gzip, deflate',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ])
                    ->timeout(30)
                    ->withOptions([
                        'verify' => true,
                        'connect_timeout' => 30,
                        'read_timeout' => 30,
                        'timeout' => 30,
                        'allow_redirects' => true,
                        'http_errors' => false,
                        'decode_content' => false
                    ])
                    ->get($imageUrl);

                if ($response->successful()) {
                    // Get image contents from response
                    $imageContents = $response->body();
                    if (!empty($imageContents)) {
                        // Generate unique filename
                        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                        $filename = 'products/' . uniqid('product_') . '_' . time() . '.' . $extension;

                        // Save to storage
                        Storage::disk('public')->put($filename, $imageContents);

                        Log::info('Product image saved successfully', [
                            'user_id' => $this->id,
                            'filename' => $filename,
                            'size' => strlen($imageContents)
                        ]);

                        // Return the public URL
                        return Storage::url($filename);
                    }
                }

                if ($attempt < $maxAttempts) {
                    Log::warning('Image download attempt failed, retrying...', [
                        'user_id' => $this->id,
                        'image_url' => $imageUrl,
                        'attempt' => $attempt,
                        'status' => $response->status()
                    ]);
                    sleep(1); // Wait 1 second before retry
                }
            } catch (\Exception $e) {
                Log::warning('Error during image download attempt', [
                    'user_id' => $this->id,
                    'image_url' => $imageUrl,
                    'attempt' => $attempt,
                    'error' => $e->getMessage()
                ]);

                if ($attempt < $maxAttempts) {
                    sleep(1); // Wait 1 second before retry
                    continue;
                }
            }
        }

        // If we get here, all attempts failed
        Log::warning('All image download attempts failed, falling back to original URL', [
            'user_id' => $this->id,
            'image_url' => $imageUrl
        ]);

        return $imageUrl; // Return original URL as fallback
    }

    private function saveProduct($productData)
    {
        return Product::updateOrCreate(
            ['twochat_id' => $productData['twochat_id']],
            $productData
        );
    }

    /**
     * Fetch products from TwoChat/WhatsApp
     */
    public function fetchProductsFromTwoChat()
    {
        try {
            // Use the TwoChatService to fetch products
            $twoChatService = app(TwoChatService::class);
            $result = $twoChatService->getProducts($this->phone);

            if (!$result['success']) {
                throw new \Exception($result['error'] ?? 'Failed to fetch products from TwoChat');
            }

            return $result['products'] ?? [];
        } catch (\Exception $e) {
            Log::error('TwoChat product fetch failed', [
                'user_id' => $this->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
