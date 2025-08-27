<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'original_price',
        'description',
        'main_banner',
        'secondary_banner',
        'delivery_content',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($product) {
        $product->slug = Product::createSlug($product->name);
    });

    static::updating(function ($product) {
        if ($product->isDirty('name')) {
            $product->slug = Product::createSlug($product->name, $product->id);
        }
    });
}

private static function createSlug($name, $id = 0)
{
    $slug = Str::slug($name);
    $originalSlug = $slug;
    
    $counter = 1;
    while (Product::where('slug', $slug)->where('id', '!=', $id)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }
    
    return $slug;
}

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

    public function features()
{
    return $this->hasMany(Feature::class)->orderBy('order');
}

public function testimonials()
{
    return $this->hasMany(Testimonial::class)->orderBy('order');
}

 public function getRouteKeyName()
    {
        return 'slug';
    }
}