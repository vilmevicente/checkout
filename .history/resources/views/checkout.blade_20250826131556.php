<!DOCTYPE html>
<html lang="pt-BR" x-data="checkout()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background-color: #f9fafb;
            color: var(--text-primary);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .shadow-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 极速赛车开奖直播 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .shadow-elevated {
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }
        
        .countdown {
            background: linear-gradient(90deg, #ef444极速赛车开奖直播4 0%, #dc2626 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.9; }
            100% { opacity: 1; }
        }
        
        .benefit-card {
            background: white;
            border-radius: 12px;
            padding: 24px 20px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .benefit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #8b5cf6);
        }

        .icon-container {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .benefit-icon {
            font-size: 24px;
            color: #4f46e5;
        }
        
        .testimonial {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            border-left: 4极速赛车开奖直播px solid #4f46e5;
        }
        
        .top-banner {
            background: linear-gradient(90deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            text-align: center;
            padding: 14px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .benefits-banner {
            background: linear-gradient(90deg, #7c3aed 0%, #8b5cf6 100极速赛车开奖直播%);
            color: white;
            text-align: center;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px rgba(124, 58, 237, 0.2);
        }
        
        .bottom-banner {
            background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
            color: white;
            text-align: center;
            padding: 16px;
            margin-top: 24px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        .security-badge {
            background: white;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .security-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(90deg, #4f46e5 0%, #6366f1 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #4338ca 0%, #4f46e5 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        input:focus, select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .checkbox:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        
        .pix-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .pix-content {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }
        
极速赛车开奖直播        .pix-success {
            color: #10b981;
            font-size: 48px;
            margin-bottom: 16px;
        }
        
        .copy-btn {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .copy-btn:hover {
            background-color: #4338ca;
        }
        
        .hidden-section {
            display: none;
        }
        
        #qrcode {
            width: 200px;
            height: 200px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        #qrcode canvas {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
{{-- reCAPTCHA --}}
@if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
  {!! NoCaptcha::renderJs() !!}
@endif
@if(App\Helpers\ConfigHelper::isFacebookPixelEnabled())
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fb极速赛车开奖直播q=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);极速赛车开奖直播t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ App\Helpers\ConfigHelper::get("facebook_pixel_id") }}');
        fbq('track', 'PageView');
    </script>
@endif
<body>
    <!-- Top Banner -->
    <div class="top-banner">
        <div class="container">
            🚀 OFERTA EXCLUSIVA: GARANTA SEU DESCONTO AGORA MESMO! 🚀
        </div>
    </div>

    <!-- Header Banner -->
    <div class="countdown text-white text-center py-3 px-4 font-bold">
        <div class="container flex flex-col md:flex-row items-center justify-center gap-2">
            <span>OFERTA RELÂMPAGO! </span>
            <span>Seu desconto expira em: </span>
            <div id="countdown-timer" class="flex items-center gap-1">
                <span class="bg-white text-red-600 px-2 py-1 rounded font-mono">15:00</span>
            </div>
        </div>
    </div>

    <!-- Checkout Header -->
    <div class="bg-white border-b shadow-card">
        <div class="container px极速赛车开奖直播-4 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
                    <p class="text-gray-600 mt-1">Complete seus dados para continuar</极速赛车开奖直播p>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-600 mt-4 md:mt-0">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="极速赛车开奖直播0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.极速赛车开奖直播04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 极速赛车开奖直播9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Compra Segura</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 01-2-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4极速赛车开奖直播h8z"></path>
                        </svg>
                        <span>Dados Protegidos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-8 flex-1">
        <!-- Banner principal -->
        <img src="/storage/{{$mainProduct['main_banner']}}" alt="Banner Principal" class="w-full mb-8 rounded-lg shadow-card">
        
        <!-- Benefits Banner -->
        <div class="benefits-banner">
            <i class="fas fa-gift mr-2"></i> SEUS BENEFÍCIOS EXCLUSIVOS
        </div>

        <!-- Features/Benefícios -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach($mainProduct['features'] as $feature)
                <div class="benefit-card shadow-card text-center p-6 rounded-xl bg-white">
                    <div class="icon-container text-indigo-600 text-3xl mb-3">
                        <i class="{{ 'fa '.$feature['icon'] }}"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $feature['name'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- FORMULÁRIO PRINCIPAL -->
        <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $mainProduct['id'] }}">

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Forms -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Customer Form -->
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <i class="fas fa-user-circle text-indigo-600 text-xl"></i>
                            <h2 class="text-lg font-semibold">Seus Dados</h2>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium text-gray-700">
                                    Nome Completo *
                                </label>
                                <div class="relative">
                                    <i class="absolute left-3 top-3 text-gray-400 fas fa-user"></i>
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Digite seu nome completo"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        required
                                        value="{{ old('name') }}"
                                        x-model="customer.name"
                                    />
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for极速赛车开奖直播="email" class="text-sm font-medium text-gray-700">
                                    E-mail *
                                </label>
                                <div class="relative">
                                    <i class="absolute left-3 top-3 text-gray-400 fas fa-envelope"></i>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        placeholder="Seu e-mail"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        required
                                        value="{{ old('email') }}"
                                        x-model="customer.email"
                                    />
                                </div>
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="confirm-email" class="text-sm font-medium text-gray-700">
                                    Confirmar E-mail *
                                </label>
                                <div class="relative">
                                    <i class="absolute left-3 top-3 text-gray-400 fas fa-envelope"></i>
                                    <input
                                        id="confirm-email"
                                        name="email_confirmation"
                                        type="email"
                                        placeholder="Confirme seu e-mail"
                                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        required
                                        value="{{ old('email_confirmation') }}"
                                        x-model="customer.email_confirmation"
                                    />
                                </div>
                                <div id="email-error" class="text-red-500 text-xs mt-1 hidden">Os e-mails não coincidem</div>
                                @error('email_confirmation')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="phone" class="text-sm font-medium text-gray-700">
                                    Telefone *
                                </label>
                                <div class="relative">
                                    <div class="absolute left-3 top-3 flex items-center">
                                        <span class="text-gray-400 mr-1">+244</span>
                                        <i class="text-gray-400 fas fa-chevron-down"></i>
                                    </div>
                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        placeholder="Seu número de telefone"
                                        class="w-full pl-16 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        required
                                        value="{{ old('phone') }}"
                                        x-model="customer.phone"
                                    />
                                </div>
                                @error('phone')
                                    <span class="text-red极速赛车开奖直播-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Upsells Section -->
                    <div class="bg-white rounded-xl shadow-elevated p-6 mb-8">
                        <h2 class="text-lg font-semibold mb-6">Você pode gostar</h2>

                        @foreach($upsells as $index => $upsell)
                            @php
                                $discountPercentage = round((($upsell['original_price'] - $upsell['price']) / $upsell['original_price']) * 100);
                            @endphp
                            <div class="flex items-start gap-4 border rounded-xl p-4 mb-6 upsell-item"> 
                                <img src="/storage/{{ $upsell['secondary_banner'] }}" 
                                     alt="{{ $upsell['name'] }}" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                
                                <div class="flex-1">
                                    <label for="upsell-{{ $index }}" class="font-medium text-sm cursor-pointer block">
                                        <input type="checkbox" 
                                               id="upsell-{{ $index }}" 
                                               name="upsells[]"
                                               value="{{ $upsell['id'] }}"
                                               class="mr-2 h-5 w-5 text-indigo-600 border-gray-300 rounded upsell-checkbox"
                                               data-price="{{ $upsell['price'] }}"
                                               data-original-price="{{ $upsell['original_price'] }}"
                                               data-name="{{ $upsell['name'] }}"
                                               {{ in_array($upsell['id'], old('upsells', [])) ? 'checked' : '' }}
                                               @change="updateUpsell('{{ $index }}', $event.target.checked, {{ $upsell['price'] }}, {{ $upsell['original_price'] }})">
                                        {{ $upsell['name'] }} - 
                                        <span class="font-semibold">R$ {{ number_format($upsell['price'], 2, ',', '.') }}</span>
                                    </label>

                                    <p class="text-xs text-gray-500 mt-1">
                                        De <span class="line-through">R$ {{ number_format($upsell['original_price'], 2, ',', '.') }}</span> 
                                        por <span class="font-semibold text-green-600">R$ {{ number_format($upsell['price'], 2, ',', '.') }}</span> 
                                        ({{ $discountPercentage }}% off)
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>
                        
                        <!-- Main Product -->
                        <div class="flex gap-3 mb-4">
                            <div class极速赛车开奖直播="w-16 h-16 rounded-md bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-indigo-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-sm">{{ $mainProduct['name'] }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-bold text-indigo-600">R$ {{ number_format($mainProduct['price'], 2, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500 line-through">
                                        R$ {{ number_format($mainProduct['original_price'], 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Upsells Selected -->
                        <div x-show="selectedUpsells.length > 0" class="mb-4">
                            <div class="border-t border-gray-200 my-4"></div>
                            <h4 class="font-medium text-sm mb-2">Itens adicionais:</h4>
                            <div id="upsells-list">
                                <template x-for="upsell in selectedUpsells" :key="upsell.id">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span x-text="upsell.name"></span>
                                        <span x-text="'R$ ' + formatPrice(upsell.price)"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Savings -->
                        <div class="flex justify-between items-center text-sm mb-4">
                            <span class="text-gray-600">Você está economizando:</span>
                            <span id="savings-amount" class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded" x-text="'R$ ' + formatPrice(totalSavings)"></span>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center text-lg font-bold pt-2 border-t border-gray-200">
                            <span>Total:</span>
                            <span id="total-amount" class="text-indigo-600" x-text="'R$ ' + formatPrice(total)"></span>
                        </div>

                        <!-- Pay Button -->
                        <button type="button" id="pay-button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 mt-4 btn-primary" @click="processPayment" :disabled="isProcessing">
                            <template x-if="!isProcessing">
                                <span><i class="fas fa-lock mr-2"></i>Pagar <span x-text="'R$ ' + formatPrice(total)"></span></span>
                            </template>
                            <template x-if="isProcessing">
                                <span><div class="loading mr-2"></div> Processando...</span>
                            </template>
                        </button>

                        @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                            <div class="mb-6 mt-4">
                                {!! NoCaptcha::display() !!}
                                @error('g-recaptcha-response')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Legal Text -->
                        <div class="text-xs text-gray-500 mt-4">
                            <p>By clicking "Pay", I declare that (i) I am aware that my purchase is being made from Kuwiy, that is the retailer and handles payments, invoices, taxes and order fulfillment; and that the creator of the product is PUBLIC DIGITAL - AGENCIA DE MARKETING DIGITAL LTDA; (ii) that I have read and agree to the Purchase Terms, Terms of Use, and Privacy Policy.</p>
                            <p class="mt-2">Report this product:</p>
                            <p class="mt-2">This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Summary -->
                <div class="space-y-6">
                    <!-- Secondary Banner -->
                    <img src="https://assets.kiwify.com.br/cdn-cgi/image/fit=scale-down,width=300/aIr8nqdegLp8KtQ/img_builder_da7b3666-3843-43c0-b82d-654cad7a67b2_d7caa1c6d0824964a63e4fa4c5ec5373.png" alt="Banner Secundário" class="w-full mb-4 rounded-lg shadow-card">

                    <!-- Depoimentos -->
                    <div class="bg-indigo-50 rounded-xl shadow-inner p-6 mb-8">
                        <h2 class="text-lg font-semibold mb-4">O que nossos clientes dizem</h2>

                        @foreach($depoimentos as $testimonial)
                            <div class="flex items-start mb-6">
                                <img src="{{ $testimonial['image'] ?? 'https://i.pravatar.cc/60' }}" 
                                     alt="{{ '@' . $testimonial['username'] }}" 
                                     class="w-12 h-12 rounded-full shadow-md mr-4">

                                <div>
                                    <p class="text-sm font-medium">
                                        <i class="fas fa-quote-left text-indigo-500 mr极速赛车开奖直播-2"></i>
                                        "{{ $testimonial['text'] }}"
                                    </p>
                                    <span class="text-xs text-indigo-600 mt-2 block">
                                        <i class="fas fa-user-circle mr-1"></i>{{ '@'.$testimonial['username'] }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Security Badges -->
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h2 class="text-lg font-semibold mb-4">Segurança</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="security-badge">
                                <i class="fas fa-shield-alt text-green极速赛车开奖直播-500 text-2xl mb-2"></i>
                                <span class="text-xs text-center block">Compra 100% Segura</span>
                           </div>
                            <div class="security-badge">
                                <i class="fas fa-lock text-blue-500 text-2xl mb-2"></i>
                                <span class="text-xs text-center block">Dados Criptografados</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal PIX -->
    <div id="pix-modal" class="pix-modal" x-show="showPixModal" style="display: none;">
        <div class="pix-content">
            <div class="pix-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="text-xl font-bold mb-4">Pagamento via PIX</h2>
            <p class="text-gray-600 mb-4">Escaneie o QR Code abaixo para finalizar o pagamento</p>
            
            <div id="qrcode" class="mb-4 mx-auto"></div>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Ou copie o código PIX:</p>
                <div class="flex items-center">
                    <input type="text" id="pix-code" readonly class="flex-1 border border-gray-300 rounded-l-lg px-3 py-2 text-sm" :value="pixCode">
                    <button id="copy-pix" class="copy-btn rounded-l-none" @click="copyPixCode">Copiar</button>
                </div>
            </div>
            
            <button id="confirm-payment" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg" @click="confirmPayment">Confirmar Pagamento</button>
            <button id="close-pix" class="w-full mt-2 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg" @click="showPixModal = false">Fechar</button>
        </div>
    </div>

    <script>
        // Configuração do timer de desconto (15 minutos)
        let timeInMinutes = 15;
        let currentTime = Date.parse(new Date());
        let deadline = new Date(currentTime + timeInMinutes*60*1000);
        
        function updateTimer() {
            let now = new Date().getTime();
            let timeLeft = deadline - now;
            
            let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            document.getElementById("countdown-timer").innerHTML = 
                `<span class="bg-white text-red-600 px-2 py-1 rounded font-mono">${minutes}:${seconds < 10 ? '0' + seconds : seconds}</span>`;
                
            if (timeLeft < 0) {
                clearInterval(timerInterval);
                document.getElementById("countdown-timer").innerHTML = "EXPIRADO!";
            }
        }
        
        let timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Formatação de telefone
        document.getElementById('phone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
            e.target.value = value;
        });

        // Validação de e-mail
        document.getElementById('confirm-email').addEventListener('blur', function (e) {
            let email = document.getElementById('email').value;
            let confirmEmail = e.target.value;
            let errorElement = document.getElementById('email-error');
            
            if (email !== confirmEmail) {
                e.target.classList.add('border-red-500');
                errorElement.classList.remove('hidden');
            } else {
                e.target.classList.remove('border-red-500');
                errorElement.classList.add('hidden');
            }
        });

        function checkout() {
            return {
                customer: {
                    name: '',
                    email: '',
                    email_confirmation: '',
                    phone: ''
                },
                selectedUpsells: [],
                total: {{ $mainProduct['price'] }},
                totalSavings: {{ $mainProduct['original_price'] - $mainProduct['price'] }},
                isProcessing: false,
                showPixModal: false,
                pixCode: '',
                
                init() {
                    // Inicializar com valores do old() se existirem
                    @if(old('name'))
                        this.customer.name = '{{ old('name') }}';
                    @endif
                    @if(old('email'))
                        this.customer.email = '{{ old('email') }}';
                    @endif
                    @if(old('email_confirmation'))
                        this.customer.email_confirmation = '{{ old('email_confirmation') }}';
                    @endif
                    @if(old('phone'))
                        this.customer.phone = '{{ old('phone') }}';
                    @endif
                    
                    // Inicializar upsells selecionados
                    @if(old('upsells'))
                        @foreach(old('upsells') as $upsellId)
                            @foreach($upsells as $index => $upsell)
                                @if($upsell['id'] == $upsellId)
                                    this.updateUpsell('{{ $index }}', true, {{ $upsell['price'] }}, {{ $upsell['original_price'] }});
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                },
                
                formatPrice(price) {
                    return price.toFixed(2).replace('.', ',');
                },
                
                updateUpsell(index, isChecked, price, originalPrice) {
                    if (isChecked) {
                        this.selectedUpsells.push({
                            id: index,
                            name: document.querySelector(`#upsell-${index}`).getAttribute('data-name'),
                            price: price,
                            originalPrice: originalPrice
                        });
                        this.total += price;
                        this.totalSavings += (originalPrice - price);
                    } else {
                        const upsellIndex = this.selectedUpsells.findIndex(item => item.id === index);
                        if (upsellIndex !== -1) {
                            this.total -= this.selectedUpsells[upsellIndex].price;
                            this.totalSavings -= (this.selectedUpsells[upsellIndex].originalPrice - this.selectedUpsells[upsellIndex].price);
                            this.selectedUpsells.splice(upsellIndex, 1);
                        }
                    }
                },
                
                async processPayment() {
                    // Validação básica do formulário
                    if (!this.customer.name || !this.customer.email || !this.customer.email_confirmation || !this.customer.phone) {
                        alert('Por favor, preencha todos os campos obrigatórios.');
                        return;
                    }
                    
                    if (this.customer.email !== this.customer.email_confirmation) {
                        alert('Os e-mails não coincidem. Por favor, verifique.');
                        return;
                    }
                    
                    this.isProcessing = true;
                    
                    try {
                        // Coletar dados do formulário
                        const formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('product_id', '{{ $mainProduct["id"] }}');
                        formData.append('name', this.customer.name);
                        formData.append('email', this.customer.email);
                        formData.append('email_confirmation', this.customer.email_confirmation);
                        formData.append('phone', this.customer.phone);
                        
                        // Adicionar upsells selecionados
                        this.selectedUpsells.forEach(upsell => {
                            formData.append('upsells[]', upsell.id);
                        });
                        
                        // Enviar via AJAX
                        const response = await fetch('{{ route("checkout.process") }}', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            this.pixCode = data.pix_code;
                            this.showPixModal = true;
                            
                            // Gerar QR Code
                            const qrElement = document.getElementById('qrcode');
                            qrElement.innerHTML = '';
                            
                            const canvas = document.createElement('canvas');
                            qrElement.appendChild(canvas);
                            
                            QRCode.toCanvas(canvas, this.pixCode, { width: 200 }, function(error) {
                                if (error) {
                                    console.error(error);
                                    qrElement.innerHTML = '<div class="text-red-500">Erro ao gerar QR Code</div>';
                                }
                            });
                        } else {
                            alert('Erro ao processar pagamento: ' + data.message);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Erro ao processar pagamento.');
                    } finally {
                        this.isProcessing = false;
                    }
                },
                
                copyPixCode() {
                    const pixCodeInput = document.getElementById('pix-code');
                    pixCodeInput.select();
                    document.execCommand('copy');
                    alert('Código PIX copiado para a área de transferência!');
                },
                
                confirmPayment() {
                    document.getElementById('checkout-form').submit();
                }
            };
        }
    </script>
</body>
</html>