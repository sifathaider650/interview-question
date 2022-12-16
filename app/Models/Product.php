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

    public function variants(){
        return $this->belongsToMany(Variant::class, 'product_variants','product_id','variant_id')
            ->withPivot([
                'variant'
            ]);
    }

    public function productVariantPrices()
    {
        return $this->hasMany(ProductVariantPrice::class, 'product_id', 'id');
    }

}
