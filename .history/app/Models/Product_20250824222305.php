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
        'secondary_banner_path',
        'delivery_content',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function upsells()
    {
        return $this->belongsToMany(Product::class, 'product_upsell', 'product_id', 'upsell_product_id')
                    ->withPivot('order', 'discount_price', 'is_active')
                    ->wherePivot('is_active', true)
                    ->withTimestamps()
                    ->orderBy('order');
    }

    public function deliveryMethods()
    {
        return $this->belongsToMany(DeliveryMethod::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class)->orderBy('order');
    }

    // Accessors para as URLs dos banners
    public function getMainBannerUrlAttribute()
    {
        return $this->main_banner_path ? asset('storage/' . $this->main_banner_path) : null;
    }

    public function getSecondaryBannerUrlAttribute()
    {
        return $this->secondary_banner_path ? asset('storage/' . $this->secondary_banner_path) : null;
    }
}