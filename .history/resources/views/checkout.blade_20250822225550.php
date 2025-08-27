<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #f8fafc;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-light: #ffffff;
            --bg-dark: #111827;
            --border-light: #e5e7eb;
            --border-dark: #374151;
            --success: #10b981;
            --pix: #32BCAD;
            --transition-speed: 300ms;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: var(--text-primary);
        }

        .shadow-card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .shadow-elevated {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .bg-gradient-card {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }
    </style>
</head>
<body>
    <!-- Checkout Header -->
    <div class="bg-white border-b shadow-card">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
                    <p class="text-gray-600 mt-1">Complete seus dados para continuar</p>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-600 mt-4 md:mt-0">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Compra Segura</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Dados Protegidos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column - Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Form -->
                <div class="bg-white rounded-lg shadow-card p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h2 class="text-lg font-semibold">Seus Dados</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700">
                                Nome Completo *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <input
                                    id="name"
                                    type="text"
                                    placeholder="Digite seu nome completo"
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-gray-700">
                                E-mail *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <input
                                    id="email"
                                    type="email"
                                    placeholder="seu@email.com"
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-medium text-gray-700">
                                Telefone *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <input
                                    id="phone"
                                    type="tel"
                                    placeholder="(11) 99999-9999"
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="document" class="text-sm font-medium text-gray-700">
                                CPF *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <input
                                    id="document"
                                    type="text"
                                    placeholder="000.000.000-00"
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-white rounded-lg shadow-elevated p-6">
                    <h2 class="text-lg font-semibold mb-6">Forma de Pagamento</h2>
                    
                    <!-- PIX Option -->
                    <div class="border-2 border-teal-400 rounded-lg p-4 bg-teal-50 mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-semibold">PIX</h3>
                                    <p class="text-sm text-gray-600">Aprovação imediata</p>
                                </div>
                            </div>
                            <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                Recomendado
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between text-lg font-bold mb-4">
                            <span>Total:</span>
                            <span class="text-teal-600">R$ 297,00</span>
                        </div>

                        <button class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-4 rounded-md transition duration-200">
                            Pagar com PIX
                        </button>
                    </div>

                    <div class="text-xs text-gray-500 text-center">
                        Ao finalizar a compra, você concorda com os termos de uso e política de privacidade.
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="space-y-6">
                <!-- Product Summary -->
                <div class="bg-white rounded-lg shadow-card p-6">
                    <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>
                    
                    <!-- Main Product -->
                    <div class="flex gap-3 mb-4">
                        <div class="w-16 h-16 rounded-md bg-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-medium text-sm">Curso Completo de Marketing Digital</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-indigo-600">R$ 297,00</span>
                                <span class="text-sm text-gray-500 line-through">
                                    R$ 497,00
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <!-- Savings -->
                    <div class="flex justify-between items-center text-sm mb-4">
                        <span class="text-gray-600">Você está economizando:</span>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            R$ 200,00
                        </span>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center text-lg font-bold pt-2 border-t border-gray-200">
                        <span>Total:</span>
                        <span class="text-indigo-600">R$ 297,00</span>
                    </div>
                </div>

                <!-- Upsell Section -->
                <div class="bg-white rounded-lg shadow-card p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h2 class="text-lg font-semibold">Adicione e Economize Mais</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Upsell Item 1 -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <div class="w-12 h-12 rounded-md bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <label class="font-medium text-sm cursor-pointer block">
                                        Módulo Bônus: Instagram Ads Avançado
                                    </label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            50% OFF
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="font-bold text-indigo-600">R$ 97,00</span>
                                        <span class="text-sm text-gray-500 line-through">
                                            R$ 197,00
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upsell Item 2 -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <div class="w-12 h-12 rounded-md bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <label class="font-medium text-sm cursor-pointer block">
                                        Templates Premium para Redes Sociais
                                    </label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            52% OFF
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="font-bold text-indigo-600">R$ 47,00</span>
                                        <span class="text-sm text-gray-500 line-through">
                                            R$ 97,00
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Upsell Item 3 -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <div class="w-12 h-12 rounded-md bg-gray-200 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <label class="font-medium text-sm cursor-pointer block">
                                        Consultoria 1:1 (30min)
                                    </label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            50% OFF
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="font-bold text-indigo-600">R$ 197,00</span>
                                        <span class="text-sm text-gray-500 line-through">
                                            R$ 397,00
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Formatação de telefone
        document.getElementById('phone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
            e.target.value = value;
        });

        // Formatação de CPF
        document.getElementById('document').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            }
            e.target.value = value;
        });

        // Simulação de seleção de upsells
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateTotal();
            });
        });

        function updateTotal() {
            // Lógica para atualizar o total quando upsells são selecionados
            console.log("Atualizar total");
        }
    </script>
</body>
</html>