<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;

class ProductDeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $customerName;
    public $content;
    public $fileUrl;

    public function __construct(Product $product, $customerName, $content, $fileUrl = null)
    {
        $this->product = $product;
        $this->customerName = $customerName;
        $this->content = $content;
        $this->fileUrl = $fileUrl;
    }

    public function build()
    {
        $email = $this->subject('Acesso ao produto: ' . $this->product->name)
                      ->view('emails.product-delivery');
        
        // Se houver um arquivo para anexar
        if ($this->fileUrl) {
            // Aqui você precisaria baixar o arquivo e anexá-lo
            // Esta é uma implementação simplificada
            $filename = basename($this->fileUrl);
            $email->attachFromStorage($this->fileUrl, $filename);
        }
        
        return $email;
    }
}