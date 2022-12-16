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
        return $this->belongsToMany(Product::class,'product_variants','product_id','variant_id')
            ->withPivot([
                'variant'
            ]);
    }

    public function productVariants(){
        return $this->hasMany(ProductVariant::class);
    }

}
