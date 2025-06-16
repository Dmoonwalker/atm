<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasCustomProductId;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasCustomProductId;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'is_available',
        'image_url',
        'user_id',
        'shop_id',
        'category_id',
        'source',
        'twochat_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'stock_quantity' => 'integer',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
