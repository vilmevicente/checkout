<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductDeliveryMail;
use Illuminate\Support\Facades\Storage;

class ProductDeliveryService
{
    public function deliverProduct(Product $product, $customerEmail, $customerName)
    {
        // Obter anexos ativos do produto
        $attachments = $product->attachments()->where('is_active', true)->orderBy('order')->get();
        
        $content = $product->delivery_content;
        
        // Enviar email com múltiplos anexos
        Mail::to($customerEmail)->send(new ProductDeliveryMail($product, $customerName, $content, $attachments));
        
        return true;
    }
}