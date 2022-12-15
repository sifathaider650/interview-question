<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                ->using('App\ProductVariant')
                ->withPivot([
                    'variant',
                    'created_by',
                    'updated_by',
                ]);
    }

}
