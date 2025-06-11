<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'user_id',
        'category_id',
        'likes',
        'opening_time',
        'closing_time',
        'state',
        'local_government',
        'is_active',
        'logo_path',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isActive()
    {
        return $this->likes >= 5;
    }

    public function updateActiveStatus()
    {
        $this->is_active = $this->isActive();
        $this->save();
    }
}
