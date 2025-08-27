<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    
    {{-- Header --}}
    <div class="bg-white dark:bg-gray-800 border-b shadow">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Finalizar Compra</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Complete seus dados para continuar</p>
            </div>
            <div class="flex items-center gap-6 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-2">
                    <x-heroicon-o-shield-check class="w-4 h-4 text-green-500"/>
                    <span>Compra Segura</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-heroicon-o-lock-closed class="w-4 h-4 text-green-500"/>
                    <span>Dados Protegidos</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Conteúdo --}}
    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Coluna Esquerda - Formulário e Pagamento --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Dados do Cliente --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
                        <x-heroicon-o-user class="w-5 h-5 text-primary"/>
                        Seus Dados
                    </h2>
                    <form action="" method="POST" class="grid md:grid-cols-2 gap-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium">Nome Completo *</label>
                            <input id="name" name="name" type="text" required
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pl-3">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium">E-mail *</label>
                            <input id="email" name="email" type="email" required
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pl-3">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium">Telefone *</label>
                            <input id="phone" name="phone" type="tel" required
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pl-3">
                        </div>
                        <div>
                            <label for="document" class="block text-sm font-medium">CPF *</label>
                            <input id="document" name="document" type="text" required
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white pl-3">
                        </div>
                    </form>
                </div>

                {{-- Pagamento --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Forma de Pagamento</h2>
                    
                    {{-- PIX Option --}}
                    <div class="border-2 border-green-500 rounded-lg p-4 bg-green-50 dark:bg-green-900/20">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-qr-code class="w-8 h-8 text-green-600"/>
                                <div>
                                    <h3 class="font-semibold">PIX</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Aprovação imediata</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Recomendado</span>
                        </div>

                        <div class="flex items-center justify-between text-lg font-bold mb-4">
                            <span>Total:</span>
                            <span class="text-green-600">R$ {{ $total ?? 297 }}</span>
                        </div>

                        <button type="button"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg">
                            Pagar com PIX
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-4">
                        Ao finalizar a compra, você concorda com os termos de uso e política de privacidade.
                    </p>
                </div>
            </div>

            {{-- Coluna Direita - Resumo e Upsells --}}
            <div class="space-y-6">

                {{-- Resumo do Pedido --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>
                    
                    <div class="flex gap-3">
                        <img src="/placeholder.svg" alt="Produto Principal"
                             class="w-16 h-16 rounded-md object-cover bg-gray-100">
                        <div>
                            <h3 class="text-sm font-medium">Curso Completo de Marketing Digital</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-primary">R$ 297</span>
                                <span class="text-sm text-gray-500 line-through">R$ 497</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200 dark:border-gray-700">

                    <div class="flex justify-between items-center text-lg font-bold">
                        <span>Total:</span>
                        <span class="text-primary">R$ {{ $total ?? 297 }}</span>
                    </div>
                </div>

                {{-- Upsells --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h2 class="text-lg font-semibold flex items-center gap-2 mb-4">
                        <x-heroicon-o-plus class="w-5 h-5 text-primary"/>
                        Adicione e Economize Mais
                    </h2>

                    {{-- Loop upsells --}}
                    @foreach($upsells ?? [] as $upsell)
                        <label class="flex items-start gap-3 border rounded-lg p-4 mb-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                            <input type="checkbox" name="upsells[]" value="{{ $upsell['id'] }}" class="mt-1">
                            <img src="{{ $upsell['image'] }}" alt="{{ $upsell['name'] }}"
                                 class="w-12 h-12 rounded-md object-cover bg-gray-100">
                            <div>
                                <span class="font-medium text-sm">{{ $upsell['name'] }}</span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-red-100 text-red-600 text-xs rounded">{{ $upsell['discount'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-bold text-primary">R$ {{ $upsell['price'] }}</span>
                                    <span class="text-sm text-gray-500 line-through">R$ {{ $upsell['originalPrice'] }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>


</body>
</html>