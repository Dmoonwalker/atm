<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUniqueStringId
{
    protected static function bootHasUniqueStringId()
    {
        static::creating(function ($model) {
            do {
                $id = Str::uuid()->toString();
            } while (static::where('id', $id)->exists());

            $model->id = $id;
        });
    }

    public function initializeHasUniqueStringId()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }
}
