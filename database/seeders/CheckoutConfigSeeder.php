<?php

namespace Database\Seeders;

use App\Models\CheckoutConfig;
use Illuminate\Database\Seeder;

class CheckoutConfigSeeder extends Seeder
{
    public function run()
    {
        CheckoutConfig::create([
            'key' => 'free_shipping_threshold',
            'value' => 100.00,
            'description' => 'Valor mínimo para frete grátis'
        ]);

        CheckoutConfig::create([
            'key' => 'default_discount_percentage',
            'value' => 10,
            'description' => 'Percentual de desconto padrão'
        ]);

        CheckoutConfig::create([
            'key' => 'checkout_timeout_minutes',
            'value' => 30,
            'description' => 'Tempo máximo para finalizar o checkout (minutos)'
        ]);

        CheckoutConfig::create([
            'key' => 'max_upsells_per_order',
            'value' => 3,
            'description' => 'Número máximo de upsells por pedido'
        ]);
    }
}