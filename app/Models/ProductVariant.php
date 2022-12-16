<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductVariant extends Model
{
    public function productVariantPrice()
    {
        return $this->belongsTo(ProductVariantPrice::class);
    }
}
