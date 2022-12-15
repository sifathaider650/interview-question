<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    /**
     * Get the product images for the product.
     */
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->using('App\ProductVariant')
            ->withPivot([
                'variant',
                'created_by',
                'updated_by',
            ]);
    }

}
