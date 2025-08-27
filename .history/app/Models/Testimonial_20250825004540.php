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
}