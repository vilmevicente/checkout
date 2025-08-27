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
    // Verificar método de entrega
    $deliveryMethods = $product->deliveryMethods;
    $content = $product->delivery_content;
    
    // Obter anexos apenas se o método de entrega for "files"
    $attachments = [];
    if ($deliveryMethods->contains('type', 'files')) {
        $attachments = $product->attachments()->where('is_active', true)->orderBy('order')->get();
    }
    
    // Enviar email
    Mail::to($customerEmail)->send(new ProductDeliveryMail($product, $customerName, $content, $attachments));
    
    return true;
}
}