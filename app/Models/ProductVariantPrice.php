<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    public function product(){
        return $this->belongsTo(Product::class,'id');
    }

    public function productVariantOne()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_one','id');
    }

    public function productVariantTwo()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_two', 'id');
    }

    public function productVariantThree()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_three', 'id');
    }

}
