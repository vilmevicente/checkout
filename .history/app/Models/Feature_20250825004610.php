<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['product_id', 'icon', 'name', 'description', 'order'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
