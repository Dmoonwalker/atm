<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasCustomProductId
{
    protected static function bootHasCustomProductId()
    {
        static::creating(function ($model) {
            do {
                $id = 'product_' . Str::random(8);
            } while (static::where('id', $id)->exists());

            $model->id = $id;
        });
    }
}
