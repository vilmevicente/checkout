@extends('layouts.ao')

@section('title', 'Configurações do Checkout')

@section('content')
<div class="bg-white shadow rounded-lg max-w-4xl mx-auto">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-6">Configurações do Checkout</h3>

        <form action="{{ route('admin.config.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Free Shipping Threshold -->
                <div>
                    <label for="free_shipping_threshold" class="block text-sm font-medium text-gray-700">
                        Valor mínimo para frete grátis
                    </label>
                    <input type="number" name="free_shipping_threshold" id="free_shipping_threshold" step="0.01" min="0"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('free_shipping_threshold', $configs['free_shipping_threshold']->value ?? '') }}">
                    <p class="mt-1 text-sm text-gray-500">Deixe em branco para desativar frete grátis.</p>
                </div>

                <!-- Default Discount -->
                <div>
                    <label for="default_discount_percentage" class="block text-sm font-medium text-gray-700">
                        Desconto padrão (%)
                    </label>
                    <input type="number" name="default_discount_percentage" id="default_discount_percentage" min="0" max="100"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('default_discount_percentage', $configs['default_discount_percentage']->value ?? '') }}">
                </div>

                <!-- Checkout Timeout -->
                <div>
                    <label for="checkout_timeout_minutes" class="block text-sm font-medium text-gray-700">
                        Tempo limite do checkout (minutos)
                    </label>
                    <input type="number" name="checkout_timeout_minutes" id="checkout_timeout_minutes" min="1" max="60"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('checkout_timeout_minutes', $configs['checkout_timeout_minutes']->value ?? '') }}">
                </div>

                <!-- Max Upsells -->
                <div>
                    <label for="max_upsells_per_order" class="block text-sm font-medium text-gray-700">
                        Máximo de upsells por pedido
                    </label>
                    <input type="number" name="max_upsells_per_order" id="max_upsells_per_order" min="1" max="10"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('max_upsells_per_order', $configs['max_upsells_per_order']->value ?? '') }}">
                </div>

                <!-- Enable Guest Checkout -->
                <div class="flex items-center">
                    <input type="checkbox" name="enable_guest_checkout" id="enable_guest_checkout" value="1" 
                           {{ old('enable_guest_checkout', $configs['enable_guest_checkout']->value ?? true) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="enable_guest_checkout" class="ml-2 block text-sm text-gray-900">
                        Permitir checkout como convidado
                    </label>
                </div>

                <!-- Require Account Creation -->
                <div class="flex items-center">
                    <input type="checkbox" name="require_account_creation" id="require_account_creation" value="1" 
                           {{ old('require_account_creation', $configs['require_account_creation']->value ?? false) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="require_account_creation" class="ml-2 block text-sm text-gray-900">
                        Exigir criação de conta
                    </label>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6">
                <h4 class="text-md font-medium text-gray-900 mb-4">Regras de Desconto Progressivo</h4>
                
                <div id="discount-rules-container">
                    <!-- Discount rules will be added here dynamically -->
                    <div class="text-center text-gray-500 py-4">
                        Funcionalidade de regras de desconto em desenvolvimento.
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Voltar
                </a>
                <button type="submit" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Salvar Configurações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection