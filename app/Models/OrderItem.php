<?php
// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_type',
        'product_id',
        'name',
        'price',
        'original_price',
        'quantity',
        'metadata'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'metadata' => 'array'
    ];

    /**
     * Pedido relacionado
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Produto relacionado (se existir)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calcular total do item
     */
    public function getTotalAttribute(): float
    {
        return $this->price * $this->quantity;
    }

    /**
     * Calcular desconto do item
     */
    public function getDiscountAttribute(): float
    {
        if ($this->original_price) {
            return $this->original_price - $this->price;
        }
        return 0;
    }
}