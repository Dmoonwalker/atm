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
        return $this->belongsTo(User::class, 'user_id', 'id');
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
        return $this->likes()->count() >= 5;
    }

    public function updateActiveStatus()
    {
        $this->is_active = $this->isActive();
        $this->save();
    }

    public function likes()
    {
        return $this->hasMany(ShopLike::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
