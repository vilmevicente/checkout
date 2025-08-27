<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Checkout</title>
</head>
<body class="bg-yellow-400 min-h-screen py-10">

    <div class="max-w-7xl mx-auto px-4">

        {{-- HEADER --}}
        <header class="bg-white border-b rounded-t-lg px-6 py-4 flex items-center justify-between shadow">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
                <p class="text-gray-500">Complete seus dados para continuar</p>
            </div>
            <div class="flex items-center gap-6 text-sm text-gray-600">
                <span class="flex items-center gap-2">
                    @svg('heroicon-o-shield-check', 'w-5 h-5 text-green-500')
                    Compra Segura
                </span>
                <span class="flex items-center gap-2">
                    @svg('heroicon-o-lock-closed', 'w-5 h-5 text-green-500')
                    Dados Protegidos
                </span>
            </div>
        </header>

        {{-- GRID --}}
        <main class="grid lg:grid-cols-3 gap-6 mt-6">

            {{-- COLUNA ESQUERDA --}}
            <section class="lg:col-span-2 space-y-6">
                
                {{-- FORM DADOS --}}
                <article class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        @svg('heroicon-o-user', 'w-5 h-5 text-indigo-600') Seus Dados
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach([
                            ['icon' => 'heroicon-o-user', 'type' => 'text', 'placeholder' => 'Digite seu nome completo'],
                            ['icon' => 'heroicon-o-envelope', 'type' => 'email', 'placeholder' => 'seu@email.com'],
                            ['icon' => 'heroicon-o-phone', 'type' => 'tel', 'placeholder' => '(11) 99999-9999'],
                            ['icon' => 'heroicon-o-document-text', 'type' => 'text', 'placeholder' => '000.000.000-00'],
                        ] as $input)
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                                    @svg($input['icon'], 'w-5 h-5')
                                </span>
                                <input type="{{ $input['type'] }}" placeholder="{{ $input['placeholder'] }}"
                                    class="w-full pl-10 pr-3 py-3 rounded-md border border-gray-300 bg-yellow-300 text-gray-900 placeholder-gray-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            </div>
                        @endforeach
                    </div>
                </article>

                {{-- FORMA DE PAGAMENTO --}}
                <article class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h2 class="text-lg font-semibold">Forma de Pagamento</h2>

                    <div class="border-2 border-green-500 rounded-lg p-4 bg-green-50">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                @svg('heroicon-o-qr-code', 'w-8 h-8 text-green-600')
                                <div>
                                    <h3 class="font-semibold">PIX</h3>
                                    <p class="text-sm text-gray-500">Aprovação imediata</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Recomendado</span>
                        </div>

                        <div class="flex items-center justify-between text-lg font-bold mb-4">
                            <span>Total:</span>
                            <span class="text-green-600">R$ 297</span>
                        </div>

                        <button class="w-full py-3 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                            Pagar com PIX
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 text-center">
                        Ao finalizar a compra, você concorda com os termos de uso e política de privacidade.
                    </p>
                </article>
            </section>

            {{-- COLUNA DIREITA --}}
            <aside class="space-y-6">
                
                {{-- RESUMO DO PEDIDO --}}
                <article class="bg-white rounded-lg shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Resumo do Pedido</h2>

                    <div class="flex gap-3">
                        <div class="w-16 h-16 bg-gray-100 rounded-md"></div>
                        <div>
                            <p class="font-medium">Curso Completo de Marketing Digital</p>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-indigo-600">R$ 297</span>
                                <span class="line-through text-gray-400">R$ 497</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-500">
                        Você está economizando: 
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded">R$ 200</span>
                    </p>

                    <hr>

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span class="text-indigo-600">R$ 297</span>
                    </div>
                </article>

                {{-- UPSELLS --}}
                <article class="bg-white rounded-lg shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        @svg('heroicon-o-plus', 'w-5 h-5 text-indigo-600') Adicione e Economize Mais
                    </h2>

                    @foreach([
                        ['title'=>'Módulo Bônus: Instagram Ads Avançado','price'=>'R$ 97','old'=>'R$ 197','discount'=>'50% OFF'],
                        ['title'=>'Templates Premium para Redes Sociais','price'=>'R$ 47','old'=>'R$ 97','discount'=>'52% OFF'],
                        ['title'=>'Consultoria 1:1 (30min)','price'=>'R$ 197','old'=>'R$ 397','discount'=>'50% OFF'],
                    ] as $upsell)
                        <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:border-indigo-400 transition">
                            <input type="radio" name="upsell" class="mt-1">
                            <div class="flex-1">
                                <p class="font-medium">{{ $upsell['title'] }}</p>
                                <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded">
                                    {{ $upsell['discount'] }}
                                </span>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-bold text-indigo-600">{{ $upsell['price'] }}</span>
                                    <span class="line-through text-gray-400">{{ $upsell['old'] }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </article>
            </aside>
        </main>
    </div>
</body>
</html>
