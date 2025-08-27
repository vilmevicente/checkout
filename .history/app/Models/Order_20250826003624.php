<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'customer_name',
        'customer_email',
        'customer_phone',
        'subtotal',
        'discount',
        'total',
        'payment_method',
        'status',
        'pix_code',
        'pix_expires_at',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'pix_expires_at' => 'datetime',
    ];

    /**
     * Itens do pedido
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Produto principal do pedido
     */
    public function mainProduct()
    {
        return $this->items()->where('product_type', 'main')->first();
    }

    /**
     * Upsells do pedido
     */
    public function upsells()
    {
        return $this->items()->where('product_type', 'upsell')->get();
    }

    /**
     * Gerar referência única
     */
    public static function generateReference(): string
    {
        do {
            $reference = 'ORD' . date('Ymd') . strtoupper(substr(uniqid(), -6));
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }

    /**
     * Verificar se o pedido está pago
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Verificar se o PIX expirou
     */
    public function isPixExpired(): bool
    {
        return $this->pix_expires_at && $this->pix_expires_at->isPast();
    }
}