<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'title' => 'Frete Grátis',
            'image_path' => 'banners/free-shipping.jpg',
            'link' => '#shipping',
            'position' => 'top',
            'is_active' => true,
            'order' => 1
        ]);

        Banner::create([
            'title' => 'Oferta Especial',
            'image_path' => 'banners/special-offer.jpg',
            'link' => '#offer',
            'position' => 'middle',
            'is_active' => true,
            'order' => 2
        ]);
    }
}