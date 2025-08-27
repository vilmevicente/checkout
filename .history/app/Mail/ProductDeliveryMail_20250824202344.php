<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\ProductAttachment;
use Illuminate\Support\Facades\Storage;

class ProductDeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $customerName;
    public $content;
    public $attachments;

    public function __construct(Product $product, $customerName, $content, $attachments = [])
    {
        $this->product = $product;
        $this->customerName = $customerName;
        $this->content = $content;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $email = $this->subject('Acesso ao produto: ' . $this->product->name)
                      ->view('emails.product-delivery');
        
        // Adicionar múltiplos anexos
        foreach ($this->attachments as $attachment) {
            // Esta é uma implementação simplificada
            // Em produção, você precisaria baixar os arquivos remotos
            // ou configurar um sistema de armazenamento adequado
            $filename = $attachment->name . '.' . $attachment->file_type;
            $email->attachFromStorage($attachment->file_url, $filename);
        }
        
        return $email;
    }
}