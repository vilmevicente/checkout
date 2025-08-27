<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryMethod;

class DeliveryMethodsTableSeeder extends Seeder
{
    public function run()
    {
        $methods = [
            [
                'name' => 'Email com conteúdo',
                'type' => 'content',
                'is_active' => true
            ],
            [
                'name' => 'Email com arquivo',
                'type' => 'file',
                'is_active' => true
            ],
            [
                'name' => 'Email com conteúdo e arquivo',
                'type' => 'both',
                'is_active' => true
            ],
        ];

        foreach ($methods as $method) {
            DeliveryMethod::create($method);
        }
    }
}