<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Configurações padrão
        \DB::table('configurations')->insert([
            [
                'key' => 'checkout_timeout_minutes',
                'value' => '15',
                'type' => 'integer',
                'description' => 'Tempo limite do checkout em minutos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'max_upsells_per_order',
                'value' => '3',
                'type' => 'integer',
                'description' => 'Máximo de upsells por pedido',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_host',
                'value' => '',
                'type' => 'string',
                'description' => 'Host do servidor SMTP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_port',
                'value' => '587',
                'type' => 'integer',
                'description' => 'Porta do servidor SMTP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_username',
                'value' => '',
                'type' => 'string',
                'description' => 'Usuário SMTP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_password',
                'value' => '',
                'type' => 'password',
                'description' => 'Senha SMTP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_encryption',
                'value' => 'tls',
                'type' => 'string',
                'description' => 'Tipo de encriptação SMTP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_from_address',
                'value' => '',
                'type' => 'string',
                'description' => 'Email de remetente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'smtp_from_name',
                'value' => '',
                'type' => 'string',
                'description' => 'Nome do remetente',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}