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
        'notes',
        'paid_at', // ← Adicionar
        'transaction_id', // ← Adiciona
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'pix_expires_at' => 'datetime',
         'paid_at' => 'datetime', // ← Adicionar
    ];

    /**
     * Itens do pedido
     */

      public function markAsPaid($status , $dateApproval,$transaction)
    {
        $this->update([
            'status' => $status,
            'updated_at' => $dateApproval,
            'notes' => json_encode($transaction),
        ]);
    }

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


    // Escopo para pedidos pagos
    public function scopePaid($query)
    {
        return $query->where('status', 'paid')->whereNotNull('paid_at');
    }

    // Escopo para pedidos pendentes
    public function scopePending($query)
    {
        return $query->where('status', 'pending')->whereNull('paid_at');
    }

}