<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['product_id', 'username', 'text', 'image', 'order'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

   // Accessor para a URL da imagem
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : 'https://i.pravatar.cc/60';
    }
    
}