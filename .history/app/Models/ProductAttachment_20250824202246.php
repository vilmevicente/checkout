<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'file_url',
        'file_type',
        'file_size',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Método para obter o tamanho formatado do arquivo
    public function getFormattedSizeAttribute()
    {
        if ($this->file_size) {
            $units = ['B', 'KB', 'MB', 'GB'];
            $bytes = $this->file_size;
            $i = floor(log($bytes, 1024));
            return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
        }
        return 'N/A';
    }
}