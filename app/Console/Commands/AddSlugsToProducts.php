<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Str;

class AddSlugsToProducts extends Command
{
    protected $signature = 'products:add-slugs';
    protected $description = 'Add slugs to existing products';

    public function handle()
    {
        $products = Product::whereNotNull('slug')->get();
        
        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            $originalSlug = $slug;
            
            $counter = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $product->slug = $slug;
            $product->save();
        }

        $this->info('Slugs added to ' . $products->count() . ' products.');
    }
}