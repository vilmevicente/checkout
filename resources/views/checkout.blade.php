<!DOCTYPE html>
<html lang="pt-BR" x-data="checkout()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
            --error: #ef4444;
            --warning: #f59e0b;
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
            max-width: 1100px;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 0px !important;
        }

        .shadow-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .shadow-elevated {
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .countdown {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
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
            padding: 10px 10px;
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
           
        }

        .benefit-icon {
            font-size: 24px;
            color: #4f46e5;
        }

        .testimonial {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #4f46e5;
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
            background: linear-gradient(90deg, #7c3aed 0%, #8b5cf6 100%);
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

        input:focus,
        select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .checkbox:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .pix-modal {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .pix-content {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            max-width: 400px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .pix-success {
            color: #10b981;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .copy-btn {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
            min-height: 42px;
        }

        .copy-btn:hover {
            background-color: #4338ca;
        }

        .copy-btn:active {
            transform: scale(0.98);
        }

        .input-error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .input-success {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .success-message {
            color: #10b981;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            z-index: 1001;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
        }

        .notification.success {
            background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
        }

        .notification.warning {
            background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
        }

        .recaptcha-error {
            border: 1px solid #ef4444;
            border-radius: 4px;
            padding: 4px;
        }

        .recaptcha-container {
            margin: 1rem 0;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        [x-cloak] {
            display: none !important;
        }

     
     .benefit-card {
    background: white;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    scroll-snap-align: start;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 150px;
    width: 100%;
    padding: 20px;
    border-radius: 8px;
    box-sizing: border-box; /* <<< ESSENCIAL */
}

/* Ajustes específicos para mobile */
@media (max-width: 767px) {
    .benefit-card {
        height: 150px;
        padding: 20px;
        border-radius: 8px;
        flex: 0 0 100%;   /* <<< cada card ocupa 100% da tela */
        max-width: 100%;  /* <<< impede overflow horizontal */
    }

    .icon-container {
        width: 50px;
        height: 50px;
        margin-bottom: 12px;
    }

    .benefit-icon {
        font-size: 22px;
    }

    .benefit-title {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .benefit-description {
        font-size: 14px;
        max-width: 90%;
    }
}

/* Desktop */
@media (min-width: 768px) {
    .benefit-card {
        padding: 24px;
        border-radius: 12px;
    }

    .benefit-icon {
        font-size: 24px;
    }

    .benefit-title {
        font-size: 18px;
        margin-bottom: 12px;
    }

    .benefit-description {
        font-size: 15px;
        max-width: 80%;
    }
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.icon-container {
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.benefit-icon {
    color: #4f46e5;
}

.benefit-title {
    font-weight: 700;
    color: #1f2937;
}

.benefit-description {
    color: #6b7280;
    line-height: 1.4;
}

.slider-container {
    position: relative;
    overflow: hidden;
}

.slider-track {
    display: flex;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.slider-dots {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    gap: 8px;
}

.slider-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #d1d5db;
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-dot.active {
    background-color: #4f46e5;
    transform: scale(1.3);
}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    z-index: 10;
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.slider-nav:hover {
    opacity: 1;
}

.slider-prev {
    left: 15px;
}

.slider-next {
    right: 15px;
}

/* Desktop - Grid */
@media (min-width: 768px) {
    .slider-container {
        width: 100%;
        margin-left: 0;
        overflow: hidden;
    }

    .slider-track {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        transform: none !important;
        width: 100%;
    }

    .benefit-card {
        margin: 0;
    }

    .slider-dots {
        display: none;
    }

    .slider-nav {
        display: none;
    }
}

/* Mobile - Slider */
@media (max-width: 767px) {
    .slider-container {
        overflow-x: hidden;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        border-radius: 12px;
    }

    .slider-container::-webkit-scrollbar {
        display: none;
    }

    .slider-track {
        display: flex;
        transition: transform 0.4s ease-in-out;
        width: auto; 
    }

    .benefit-card {
        flex: 0 0 100%; /* cada card ocupa 100% */
        max-width: 100%;
         box-sizing: border-box;
    }

    /* Mostrar setas apenas se não for touch device */
    @media (hover: hover) {
        .slider-nav {
            display: flex;
        }
    }
}

.benefit-card {
  box-sizing: border-box; /* padding conta dentro da largura */
}

.slider-track {
  overflow: hidden; /* evita vazar conteúdo */
}

@media (max-width: 448px) {
    .benefit-card {
        flex: 0 0 100%;
        max-width: 100%;
        padding-left: 12px;
        padding-right: 12px;
        box-sizing: border-box; /* padding não soma na largura */
    }

    .slider-track {
        width: auto !important;   /* evita overflow */
    }

    .slider-container {
        overflow-x: hidden;
    }
}


    </style>
</head>



{{-- reCAPTCHA --}}
@if(App\Helpers\ConfigHelper::isGooglePixelEnabled())

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ App\Helpers\ConfigHelper::get("google_pixel_id") }}');</script>
   
@endif



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
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ App\Helpers\ConfigHelper::get("facebook_pixel_id") }}');
fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none;" 
         src="https://www.facebook.com/tr?id={{ App\Helpers\ConfigHelper::get('facebook_pixel_id') }}&ev=PageView&noscript=1"
         alt="Facebook Pixel" loading="lazy" />
</noscript>
<!-- End Meta Pixel Code -->
@endif

<body>


 @if(App\Helpers\ConfigHelper::isGooglePixelEnabled())
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ App\Helpers\ConfigHelper::get("google_pixel_id") }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @endif


    <!-- Notification System -->
    <div class="notification error" id="error-notification" style="display: none;">
        <i class="fas fa-exclamation-circle"></i>
        <span id="error-message"></span>
    </div>

    <div class="notification success" id="success-notification" style="display: none;">
        <i class="fas fa-check-circle"></i>
        <span id="success-message"></span>
    </div>

   
      <div class="container px-4 py-8 flex-1">

<div class="z-50 text-center mx-auto bg-opacity-75 w-full py-6" style="margin-left: -5px;"><div class="p-2"><div class="w-full relative p-2"><!---->
     <div class="flex items-center h-full justify-center w-full">
        <div class="flex items-center justify-center flex-wrap">
            <div class="text-4xl">
                <div data-v-7c035809="">
                    <div data-v-7c035809="">

                    </div> 
                    <div id="countdown-timer"><!---->
                        <span>04</span>:<span >42</span>
                    </div> 
                    <div data-v-7c035809="">

                    </div> <!----></div> <!----></div> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#4f46e5" width="36px" height="36px" class="mx-4"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg> 
    
    <div class="text-sm font-medium" id="timerText">
            Aproveite agora o desconto especial!
          </div> </div></div></div></div></div>

        <!-- Banner principal -->
        <img src="/storage/{{ $mainProduct['main_banner'] }}" alt="Banner Principal" class="w-full mb-8 rounded-lg shadow-card">

       
      
        
    

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
                                        :class="{ 'input-error': errors.name, 'input-success': fields.name && !errors.name }"
                                        required
                                        value="{{ old('name') }}"
                                        x-model="customer.name"
                                        @blur="validateField('name')" />
                                </div>
                                <div class="error-message" x-show="errors.name">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span x-text="errors.name"></span>
                                </div>
                                @error('name')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium text-gray-700">
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
                                        :class="{ 'input-error': errors.email, 'input-success': fields.email && !errors.email }"
                                        required
                                        value="{{ old('email') }}"
                                        x-model="customer.email"
                                        @blur="validateField('email')" />
                                </div>
                                <div class="error-message" x-show="errors.email">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span x-text="errors.email"></span>
                                </div>
                                @error('email')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>



                            <div class="space-y-2">
                                <label for="phone" class="text-sm font-medium text-gray-700">
                                    Telefone *
                                </label>
                                <div class="relative">
                                    <div class="absolute left-3 top-3 flex items-center">
                                        <span class="text-gray-400 mr-1">+55</span>
                                        <i class="text-gray-400 fas fa-chevron-down"></i>
                                    </div>
                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        placeholder="Seu número de telefone"
                                        class="w-full pl-16 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        :class="{ 'input-error': errors.phone, 'input-success': fields.phone && !errors.phone }"
                                        required
                                        value="{{ old('phone') }}"
                                        x-model="customer.phone"
                                        @blur="validateField('phone')"
                                        @input="formatPhone" />
                                </div>
                                <div class="error-message" x-show="errors.phone">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span x-text="errors.phone"></span>
                                </div>
                                @error('phone')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                  
                    <!-- Order Summary -->
                    <div class="bg-white rounded-xl shadow-card p-6">
                        <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>

                        <!-- Main Product -->
                        <div class="flex gap-3 mb-4">
                            <div class="w-16 h-16 rounded-md bg-indigo-100 flex items-center justify-center">
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
                                <span>
                                    <div class="loading mr-2"></div> Processando...
                                </span>
                            </template>
                        </button>

                        @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                        <div class="recaptcha-container" :class="{ 'recaptcha-error': errors.recaptcha }">
                            {!! NoCaptcha::display() !!}
                            <div class="error-message" x-show="errors.recaptcha">
                                <i class="fas fa-exclamation-circle"></i>
                                <span x-text="errors.recaptcha"></span>
                            </div>
                            @error('g-recaptcha-response')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        @endif

                        <!-- Legal Text -->
                        <div class="text-xs text-gray-500 mt-4">
                            <p>{{ App\Helpers\ConfigHelper::get("copyright_text") }}</p>
                        </div>
                    </div>


                      <!-- Upsells Section -->
                    <div class="bg-white rounded-xl shadow-elevated p-6 mb-8">
                        <h2 class="text-lg font-semibold mb-6">Adicione e Economize Mais</h2>

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
                                        @change="updateUpsell('{{ $index }}', $event.target.checked, {{ $upsell['price'] }}, {{ $upsell['original_price'] }}, {{ $upsell['id'] }})">
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


                    <!-- Benefits Section SIMPLES -->
<div>
     <div class="benefits-banner">
            <i class="fas fa-gift mr-2"></i> SEUS BENEFÍCIOS EXCLUSIVOS
        </div>

        <!-- Slider de Benefícios -->
      
        
        <div class="content">
            
              <div 
  x-data="slider()" 
  x-init="init()"
  class="relative overflow-hidden"
>
    <!-- Track -->
    <div 
      class="slider-track transition-transform duration-500 ease-in-out"
      :class="isMobile ? 'flex flex-nowrap' : 'grid grid-cols-3 gap-4'"
      :style="isMobile ? 'transform: translateX(-' + (currentIndex * 100) + '%)' : ''"
    >
        <template x-for="(feature, index) in features" :key="index">
            <div 
              class="benefit-card bg-white p-6 rounded-2xl shadow-md text-center"
              :class="isMobile ? 'flex-shrink-0 w-[100%] box-border' : ''"
:style="isMobile ? 'width:' + slideWidth + 'px' : ''"

            >
                <div class="icon-container text-4xl text-indigo-600 mb-4">
                    <i :class="'fa ' + feature.icon"></i>
                </div>
                <h3 class="benefit-title font-semibold text-lg mb-2" x-text="feature.name"></h3>
                <p class="benefit-description text-gray-600" x-text="feature.description"></p>
            </div>
        </template>
    </div>

    <!-- Dots (só mobile) -->
    <div class="flex justify-center mt-4" x-show="isMobile">
        <template x-for="(feature, index) in features" :key="'dot'+index">
            <button 
                class="w-3 h-3 mx-1 rounded-full transition"
                :class="currentIndex === index ? 'bg-indigo-600 scale-110' : 'bg-gray-400'"
                @click="goTo(index)">
            </button>
        </template>
    </div>
</div>



        </div>
</div>
                </div>

                <!-- Right Column - Summary -->
                <div class="space-y-6">
                    <!-- Secondary Banner -->
                    <img src="/storage/{{ $mainProduct['secondary_banner'] }}" alt="Banner Secundário" class="w-full mb-4 rounded-lg shadow-card">

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
                                    <i class="fas fa-quote-left text-indigo-500 mr-2"></i>
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
                                <i class="fas fa-shield-alt text-green-500 text-2xl mb-2"></i>
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
    <div id="pix-modal" class="pix-modal" x-show="showPixModal" x-cloak>
        <div class="pix-content">
            <!-- Header com ícone -->
            <div class="text-center mb-4">
                <div class="pix-success mx-auto">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mt-2">Pagamento Gerado!</h2>
            </div>

            <!-- Mensagens consolidadas -->
            <div class="text-center mb-6">
                <p class="text-gray-600 text-sm mb-3">
                    <i class="fas fa-qrcode text-indigo-500 mr-1"></i>
                    Escaneie o QR Code ou copie o código PIX
                </p>
                <p class="text-gray-500 text-xs">
                    <i class="fas fa-envelope text-indigo-400 mr-1"></i>
                    Enviamos uma cópia para seu e-mail 📧
                </p>
                <p class="text-green-600 text-xs font-medium mt-2">
                    <i class="fas fa-clock text-green-500 mr-1"></i>
                    Válido por 30 minutos ⏰
                </p>
            </div>

            <!-- QR Code -->
            <div id="qrcode" class="mb-6 mx-auto" style="max-width: 180px;"></div>

            <!-- Código PIX -->
            <div class="mb-6">
                <p class="text-sm text-gray-600 mb-2 font-medium">
                    <i class="fas fa-copy text-indigo-500 mr-1"></i>
                    Ou copie o código:
                </p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input 
                        type="text" 
                        id="pix-code" 
                        readonly 
                        class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm bg-gray-50 font-mono truncate" 
                        :value="pixCode"
                        x-ref="pixInput"
                    >
                    <button 
                        id="copy-pix" 
                        class="copy-btn rounded-lg whitespace-nowrap px-4 py-2 text-sm flex items-center justify-center gap-1"
                        @click="copyPixCode"
                    >
                        <i class="fas fa-copy"></i>
                        Copiar
                    </button>
                </div>
            </div>

            <!-- Botões -->
            <div class="flex flex-col gap-2">
               <button 
    id="confirm-payment" 
    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center gap-2"
    @click="confirmPayment"
    :disabled="isProcessing"
>
    <template x-if="!isProcessing">
        <span>
            <i class="fas fa-check"></i>
            Já Paguei
        </span>
    </template>
    <template x-if="isProcessing">
        <span>
            <div class="loading mr-2"></div> Processando...
        </span>
    </template>
</button>
                <button 
                    id="close-pix" 
                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-lg font-medium transition-colors"
                    @click="showPixModal = false"
                >
                    Fechar
                </button>
            </div>

            <!-- Informação adicional -->
            <div class="mt-4 text-center">
                <p class="text-xs text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    Após o pagamento, liberaremos seu acesso em até 5 minutos
                </p>
            </div>
        </div>
    </div>

    <script>
        // Configuração do timer de desconto (15 minutos)
        let timeInMinutes = 15;
        let currentTime = Date.parse(new Date());
        let deadline = new Date(currentTime + timeInMinutes * 60 * 1000);

        function updateTimer() {
            let now = new Date().getTime();
            let timeLeft = deadline - now;

            let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById("countdown-timer").innerHTML =
                `<span>${minutes}</span>:<span >${seconds < 10 ? '0' + seconds : seconds}</span>`;

            if (timeLeft < 0) {
                clearInterval(timerInterval);
                document.getElementById("timerText").innerHTML = "EXPIRADO!";
            }
        }

        let timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Função para mostrar notificações
        function showNotification(type, message) {
            const notification = document.getElementById(`${type}-notification`);
            const messageElement = document.getElementById(`${type}-message`);

            messageElement.textContent = message;
            notification.style.display = 'flex';
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 300);
            }, 5000);
        }


        function slider() {
  return {
    cards: [
      { title: "Slide 1", text: "Conteúdo do slide 1" },
      { title: "Slide 2", text: "Conteúdo do slide 2" },
      { title: "Slide 3", text: "Conteúdo do slide 3" },
    ],
    currentIndex: 0,
    isMobile: window.innerWidth < 768,
    interval: null,

    init() {
      // Auto-slide apenas no mobile
      if (this.isMobile) {
        this.startAutoSlide();
      }
      // Atualiza se redimensionar
      window.addEventListener('resize', () => {
        this.isMobile = window.innerWidth < 768;
        if (this.isMobile) {
          this.startAutoSlide();
        } else {
          this.stopAutoSlide();
          this.currentIndex = 0; // reset no desktop
        }
      });
    },

    startAutoSlide() {
      this.stopAutoSlide();
      this.interval = setInterval(() => {
        this.next();
      }, 3000); // 3s
    },

    stopAutoSlide() {
      if (this.interval) clearInterval(this.interval);
    },

    next() {
      this.currentIndex = (this.currentIndex + 1) % this.cards.length;
    },

    goTo(i) {
      this.currentIndex = i;
    }
  }
}


        function checkout() {
            return {
                customer: {
                    name: '',
                    email: '',
                    email_confirmation: '',
                    phone: ''
                },
                fields: {
                    name: false,
                    email: false,
                    email_confirmation: false,
                    phone: false
                },
                errors: {
                    name: '',
                    email: '',
                    email_confirmation: '',
                    phone: '',
                    recaptcha: ''
                },
                selectedUpsells: [],
                total: {{ $mainProduct['price'] }},
                totalSavings: {{ $mainProduct['original_price'] - $mainProduct['price'] }},
                isProcessing: false,
                showPixModal: false,
                pixCode: '',
                features: @json($mainProduct['features']),
                paymentSuccess:'',
                success_redirect_link: '{{$mainProduct['success_redirect_link']}}',
                
                init() {
                    // Inicializar com valores do old() se existirem
                    @if(old('name'))
                        this.customer.name = '{{ old('name') }}';
                        this.fields.name = true;
                    @endif
                    @if(old('email'))
                        this.customer.email = '{{ old('email') }}';
                        this.fields.email = true;
                    @endif
                    @if(old('email_confirmation'))
                        this.customer.email_confirmation = '{{ old('email_confirmation') }}';
                        this.fields.email_confirmation = true;
                    @endif
                    @if(old('phone'))
                        this.customer.phone = '{{ old('phone') }}';
                        this.fields.phone = true;
                    @endif
                    
                    // Inicializar upsells selecionados
                    @if(old('upsells'))
                        @foreach(old('upsells') as $upsellId)
                            @foreach($upsells as $index => $upsell)
                                @if($upsell['id'] == $upsellId)
                                    this.updateUpsell('{{ $index }}', true, {{ $upsell['price'] }}, {{ $upsell['original_price'] }}, {{ $upsell['id'] }});
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                },
                
                validateField(field) {
                    this.fields[field] = true;
                    
                    switch(field) {
                        case 'name':
                            this.errors.name = this.customer.name ? '' : 'Nome é obrigatório.';
                            break;
                        case 'email':
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!this.customer.email) {
                                this.errors.email = 'E-mail é obrigatório.';
                            } else if (!emailRegex.test(this.customer.email)) {
                                this.errors.email = 'E-mail inválido.';
                            } else {
                                this.errors.email = '';
                            }
                            break;

                        case 'phone':
                            const phone = this.customer.phone.replace(/\D/g, '');
                            if (!this.customer.phone) {
                                this.errors.phone = 'Telefone é obrigatório.';
                            } else if (phone.length < 10) {
                                this.errors.phone = 'Telefone inválido. Digite o DDD + número.';
                            } else if (phone.length > 11) {
                                this.errors.phone = 'Telefone muito longo.';
                            } else {
                                this.errors.phone = '';
                            }
                            break;
                    }
                },
                
                formatPhone() {
                    // Salvar posição do cursor
                    const input = event.target;
                    const cursorPosition = input.selectionStart;
                    const originalValue = this.customer.phone;
                    
                    let value = this.customer.phone.replace(/\D/g, '');
                    
                    // Limitar a 11 dígitos
                    if (value.length > 11) {
                        value = value.substring(0, 11);
                    }
                    
                    // Aplicar máscara
                    let formattedValue = value;
                    
                    if (value.length > 2) {
                        formattedValue = `(${value.substring(0, 2)}) ${value.substring(2)}`;
                    }
                    if (value.length > 6) {
                        formattedValue = `(${value.substring(0, 2)}) ${value.substring(2, 6)}-${value.substring(6)}`;
                    }
                    if (value.length > 7) {
                        formattedValue = `(${value.substring(0, 2)}) ${value.substring(2, 7)}-${value.substring(7)}`;
                    }
                    
                    this.customer.phone = formattedValue;
                    
                    // Restaurar posição do cursor (ajustada para a máscara)
                    setTimeout(() => {
                        let newCursorPosition = cursorPosition;
                        
                        // Ajustar posição baseado na formatação
                        if (value.length <= 2 && originalValue.length <= 2) {
                            // Dentro do DDD - mantém posição
                            newCursorPosition = cursorPosition;
                        } else if (cursorPosition === 2 && value.length > 2) {
                            // Após o DDD - move para após o parêntese
                            newCursorPosition = 3;
                        } else if (cursorPosition === 3 && originalValue.length === 2 && value.length > 2) {
                            // Após adicionar parêntese - move para espaço
                            newCursorPosition = 4;
                        } else if (cursorPosition >= 3 && value.length > 2) {
                            // Ajustar para posições após formatação
                            newCursorPosition = cursorPosition + 2;
                        }
                        
                        input.setSelectionRange(newCursorPosition, newCursorPosition);
                    }, 0);
                },
                
                phoneKeydown(event) {
                    // Permitir apenas teclas numéricas e teclas de controle
                    const allowedKeys = [
                        'Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 
                        'ArrowLeft', 'ArrowRight', 'Home', 'End'
                    ];
                    
                    if (allowedKeys.includes(event.key) || 
                        (event.key >= '0' && event.key <= '9') ||
                        (event.ctrlKey || event.metaKey)) {
                        return true;
                    }
                    
                    event.preventDefault();
                    return false;
                },
                
                validateForm() {
                    // Validar todos os campos
                    this.validateField('name');
                    this.validateField('email');
                    this.validateField('email_confirmation');
                    this.validateField('phone');
                    
                    // Validar reCAPTCHA
                    let recaptchaValid = true;
                    @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                        if (typeof grecaptcha !== 'undefined') {
                            const recaptchaResponse = grecaptcha.getResponse();
                            if (!recaptchaResponse) {
                                this.errors.recaptcha = 'Por favor, complete o reCAPTCHA.';
                                recaptchaValid = false;
                            } else {
                                this.errors.recaptcha = '';
                            }
                        } else {
                            this.errors.recaptcha = 'reCAPTCHA não carregado. Recarregue a página.';
                            recaptchaValid = false;
                        }
                    @endif
                    
                    // Verificar se há erros
                    const hasErrors = Object.values(this.errors).some(error => error !== '');
                    
                    return !hasErrors && recaptchaValid;
                },
                
                formatPrice(price) {
                    return price.toFixed(2).replace('.', ',');
                },
                
                updateUpsell(index, isChecked, price, original_price, id) {
                    if (isChecked) {
                        this.selectedUpsells.push({
                            index,
                            id,
                            name: document.querySelector(`#upsell-${index}`).getAttribute('data-name'),
                            price: price,
                            original_price: original_price
                        });
                        this.total += price;
                        this.totalSavings += (original_price - price);
                    } else {
                        const upsellIndex = this.selectedUpsells.findIndex(item => item.index === index);
                        if (upsellIndex !== -1) {
                            this.total -= this.selectedUpsells[upsellIndex].price;
                            this.totalSavings -= (this.selectedUpsells[upsellIndex].original_price - this.selectedUpsells[upsellIndex].price);
                            this.selectedUpsells.splice(upsellIndex, 1);
                        }
                    }
                },
                
                async processPayment() {
                    if (!this.validateForm()) {
                        // Encontrar o primeiro campo com erro
                        const firstErrorField = Object.keys(this.errors).find(key => this.errors[key] !== '');
                        if (firstErrorField) {
                            const element = document.querySelector(`[x-model="customer.${firstErrorField}"]`) || 
                                          document.querySelector('.recaptcha-error');
                            if (element) {
                                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                element.focus();
                            }
                        }
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
                        
                        // Limpar máscara do telefone antes de enviar
                        const cleanPhone = this.customer.phone.replace(/\D/g, '');
                        formData.append('phone', cleanPhone);
                        
                        // Adicionar upsells selecionados
                        this.selectedUpsells.forEach(upsell => {
                            formData.append('upsells[]', upsell.id);
                        });
                        
                        // Adicionar reCAPTCHA
                        @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                            if (typeof grecaptcha !== 'undefined') {
                                const recaptchaResponse = grecaptcha.getResponse();
                                if (recaptchaResponse) {
                                    formData.append('g-recaptcha-response', recaptchaResponse);
                                }
                            }
                        @endif
                        
                        // Enviar via AJAX
                        const response = await fetch('{{ route("checkout.process") }}', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // LIMPAR TODOS OS CAMPOS APÓS SUCESSO
                            this.resetForm();
                            
                            this.pixCode = data.order.pix_code;
                            this.showPixModal = true;
                            
                            // Gerar QR Code
                            const qrElement = document.getElementById('qrcode');
                            qrElement.innerHTML = '';
                            
                            const canvas = document.createElement('canvas');
                            qrElement.appendChild(canvas);
                            
                            this.paymentSuccess = data.order.reference

                            QRCode.toCanvas(canvas, this.pixCode, { width: 200 }, function(error) {
                                if (error) {
                                    console.error(error);
                                    qrElement.innerHTML = '<div class="text-red-500">Erro ao gerar QR Code</div>';
                                }
                            });
                            
                        } else {
                            // EM CASO DE ERRO, LIMPAR APENAS O CAPTCHA
                            @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                                if (typeof grecaptcha !== 'undefined') {
                                    grecaptcha.reset();
                                }
                            @endif
                            
                            // Limpar erro do captcha se houver
                            this.errors.recaptcha = '';
                            
                            showNotification('error', data.message || 'Erro ao processar pagamento.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        
                        // EM CASO DE ERRO DE REDE, LIMPAR O CAPTCHA
                        @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                            if (typeof grecaptcha !== 'undefined') {
                                grecaptcha.reset();
                            }
                        @endif
                        
                        showNotification('error', 'Erro ao processar pagamento.');
                    } finally {
                        this.isProcessing = false;
                    }
                },
                
                copyPixCode() {
                    this.$refs.pixInput.select();
                    document.execCommand('copy');
                    
                    // Feedback visual
                    const button = document.getElementById('copy-pix');
                    const originalText = button.innerHTML;
                    
                    button.innerHTML = '<i class="fas fa-check"></i> Copiado!';
                    button.style.background = '#10b981';
                    
                    showNotification('success', 'Código PIX copiado! ✔️');
                    
                    // Reset após 2 segundos
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.style.background = '';
                    }, 2000);
                },
               async confirmPayment() {
                const reference = this.paymentSuccess

                if (!reference) {
                    return;
                }
    try {
        
        this.isProcessing = true
        const response = await fetch(`/checkout/success/${reference}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (data.success) {
             this.isProcessing = false
            showNotification('success', 'Pagamento confirmado com sucesso! ✔️');
            if (this.success_redirect_link) {
                setTimeout(() => {
                    window.location.href = this.success_redirect_link;
                }, 1500);
            }
        } else {
            this.isProcessing = false
            showNotification('error', data.message || 'O pagamento ainda está pendente');
        }
    } catch (error) {
        showNotification('error', 'Ocorreu um erro ao confirmar o pagamento. Tente novamente.');
        console.error(error);
    }
},
                
                resetForm() {
                    this.customer = {
                        name: '',
                        email: '',
                        email_confirmation: '',
                        phone: ''
                    };
                    this.fields = {
                        name: false,
                        email: false,
                        email_confirmation: false,
                        phone: false
                    };
                    this.errors = {
                        name: '',
                        email: '',
                        email_confirmation: '',
                        phone: '',
                        recaptcha: ''
                    };
                    this.selectedUpsells = [];
                    this.total = {{ $mainProduct['price'] }};
                    this.totalSavings = {{ $mainProduct['original_price'] - $mainProduct['price'] }};
                    
                    // Resetar todos os checkboxes de upsells
                    document.querySelectorAll('input[type="checkbox"][name="upsells[]"]').forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    
                    // Resetar reCAPTCHA
                    @if(App\Helpers\ConfigHelper::isRecaptchaEnabled())
                        if (typeof grecaptcha !== 'undefined') {
                            grecaptcha.reset();
                        }
                    @endif
                }
            };
        }

        // Adicione esta função para fechar o modal ao clicar fora
        document.addEventListener('click', (e) => {
            const pixModal = document.getElementById('pix-modal');
            const pixContent = document.querySelector('.pix-content');
            
            if (pixModal && pixModal.style.display === 'flex' && 
                !pixContent.contains(e.target) && 
                !e.target.closest('.pix-content')) {
                this.showPixModal = false;
            }
        });

        // Adicione suporte a tecla ESC para fechar
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.showPixModal) {
                this.showPixModal = false;
            }
        });

        
    </script>
</body>
</html>