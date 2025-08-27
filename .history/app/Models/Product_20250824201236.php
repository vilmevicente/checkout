<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'original_price',
        'description',
        'main_banner',
        'secondary_banner',
        'delivery_content',
        'delivery_file',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function upsells()
    {
        return $this->belongsToMany(Upsell::class)
                    ->withPivot('order')
                    ->orderBy('order');
    }

    public function deliveryMethods()
    {
        return $this->belongsToMany(DeliveryMethod::class);
    }
}