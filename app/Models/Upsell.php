<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upsell extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'image_path',
        'is_active',
        'order',
        'discount_percentage'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_percentage' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percentage) {
            return $this->original_price * (1 - $this->discount_percentage / 100);
        }
        return $this->price;
    }
}