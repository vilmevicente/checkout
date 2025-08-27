<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    

<div class="min-h-screen bg-yellow-400 py-10">
    <div class="max-w-7xl mx-auto px-4">
        
        {{-- HEADER --}}
        <div class="bg-white border-b rounded-t-lg px-6 py-4 flex items-center justify-between shadow">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
                <p class="text-gray-500">Complete seus dados para continuar</p>
            </div>
            <div class="flex items-center gap-6 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    @svg('heroicon-o-shield-check', 'w-5 h-5 text-green-500')
                    Compra Segura
                </div>
                <div class="flex items-center gap-2">
                    @svg('heroicon-o-lock-closed', 'w-5 h-5 text-green-500')
                    Dados Protegidos
                </div>
            </div>
        </div>

        {{-- GRID --}}
        <div class="grid lg:grid-cols-3 gap-6 mt-6">

            {{-- COLUNA ESQUERDA --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- FORM DADOS --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        @svg('heroicon-o-user', 'w-5 h-5 text-indigo-600')
                        Seus Dados
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        {{-- Nome --}}
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                                @svg('heroicon-o-user', 'w-5 h-5')
                            </span>
                            <input type="text" placeholder="Digite seu nome completo"
                                class="w-full pl-10 pr-3 py-3 rounded-md border border-gray-300 bg-yellow-300 text-gray-900 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Email --}}
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                                @svg('heroicon-o-envelope', 'w-5 h-5')
                            </span>
                            <input type="email" placeholder="seu@email.com"
                                class="w-full pl-10 pr-3 py-3 rounded-md border border-gray-300 bg-yellow-300 text-gray-900 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- Telefone --}}
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                                @svg('heroicon-o-phone', 'w-5 h-5')
                            </span>
                            <input type="tel" placeholder="(11) 99999-9999"
                                class="w-full pl-10 pr-3 py-3 rounded-md border border-gray-300 bg-yellow-300 text-gray-900 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        {{-- CPF --}}
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                                @svg('heroicon-o-document-text', 'w-5 h-5')
                            </span>
                            <input type="text" placeholder="000.000.000-00"
                                class="w-full pl-10 pr-3 py-3 rounded-md border border-gray-300 bg-yellow-300 text-gray-900 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>

                {{-- FORMA DE PAGAMENTO --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h2 class="text-lg font-semibold">Forma de Pagamento</h2>

                    {{-- PIX --}}
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

                        <button class="w-full py-3 rounded-lg bg-green-600 text-white hover:bg-green-700">
                            Pagar com PIX
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 text-center">
                        Ao finalizar a compra, você concorda com os termos de uso e política de privacidade.
                    </p>
                </div>
            </div>

            {{-- COLUNA DIREITA --}}
            <div class="space-y-6">
                
                {{-- RESUMO DO PEDIDO --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-4">
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

                    <p class="text-sm text-gray-500">Você está economizando: 
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded">R$ 200</span>
                    </p>

                    <hr>

                    <div class="flex justify-between font-bold text-lg">
                        <span>Total:</span>
                        <span class="text-indigo-600">R$ 297</span>
                    </div>
                </div>

                {{-- UPSELLS --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-4">
                    <h2 class="text-lg font-semibold flex items-center gap-2">
                        @svg('heroicon-o-plus', 'w-5 h-5 text-indigo-600')
                        Adicione e Economize Mais
                    </h2>

                    {{-- Upsell Card --}}
                    <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer">
                        <input type="radio" name="upsell" class="mt-1">
                        <div class="flex-1">
                            <p class="font-medium">Módulo Bônus: Instagram Ads Avançado</p>
                            <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded">50% OFF</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-indigo-600">R$ 97</span>
                                <span class="line-through text-gray-400">R$ 197</span>
                            </div>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer">
                        <input type="radio" name="upsell" class="mt-1">
                        <div class="flex-1">
                            <p class="font-medium">Templates Premium para Redes Sociais</p>
                            <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded">52% OFF</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-indigo-600">R$ 47</span>
                                <span class="line-through text-gray-400">R$ 97</span>
                            </div>
                        </div>
                    </label>

                    <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer">
                        <input type="radio" name="upsell" class="mt-1">
                        <div class="flex-1">
                            <p class="font-medium">Consultoria 1:1 (30min)</p>
                            <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded">50% OFF</span>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-indigo-600">R$ 197</span>
                                <span class="line-through text-gray-400">R$ 397</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>