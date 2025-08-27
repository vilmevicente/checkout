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
    'file_path',
    'original_name',
    'mime_type',
    'size',
    'order',
    'is_active'
];

// Adicionar accessor para URL completa
public function getFileUrlAttribute()
{
    return asset('storage/' . $this->file_path);
}

// Manter o formatted_size para exibição
public function getFormattedSizeAttribute()
{
    if ($this->size) {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = $this->size;
        $i = floor(log($bytes, 1024));
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }
    return 'N/A';
}
}