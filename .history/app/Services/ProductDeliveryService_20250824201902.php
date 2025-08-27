<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductDeliveryMail;

class ProductDeliveryService
{
    public function deliverProduct(Product $product, $customerEmail, $customerName)
    {
        // Verificar métodos de entrega do produto
        $deliveryMethods = $product->deliveryMethods;
        
        $content = $product->delivery_content;
        $fileUrl = $product->delivery_file;
        
        // Enviar email
        Mail::to($customerEmail)->send(new ProductDeliveryMail($product, $customerName, $content, $fileUrl));
        
        return true;
    }
}