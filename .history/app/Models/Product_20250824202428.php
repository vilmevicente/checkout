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
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relação com upsells (outros produtos)
    public function upsells()
    {
        return $this->belongsToMany(Product::class, 'product_upsell', 'product_id', 'upsell_product_id')
                    ->withPivot('order', 'discount_price', 'is_active')
                    ->wherePivot('is_active', true)
                    ->withTimestamps()
                    ->orderBy('order');
    }

    // Relação inversa para saber onde este produto é upsell
    public function upsellOf()
    {
        return $this->belongsToMany(Product::class, 'product_upsell', 'upsell_product_id', 'product_id')
                    ->withPivot('order', 'discount_price', 'is_active')
                    ->withTimestamps();
    }

    public function deliveryMethods()
    {
        return $this->belongsToMany(DeliveryMethod::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class)->orderBy('order');
    }

    // Método para obter o preço do upsell (com desconto se aplicável)
    public function getUpsellPrice(Product $mainProduct)
    {
        $pivot = $this->upsellOf()->where('product_id', $mainProduct->id)->first();
        
        if ($pivot && $pivot->pivot->discount_price) {
            return $pivot->pivot->discount_price;
        }
        
        return $this->price;
    }

    // Método para verificar se este produto é um upsell de outro
    public function isUpsellFor(Product $product)
    {
        return $this->upsellOf()->where('product_id', $product->id)->exists();
    }
}