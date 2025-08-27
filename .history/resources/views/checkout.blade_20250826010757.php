<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    
   @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Seus estilos CSS permanecem os mesmos */
        :root { /* ... */ }
        * { /* ... */ }
        body { /* ... */ }
        .container { /* ... */ }
        .shadow-card { /* ... */ }
        .shadow-elevated { /* ... */ }
        .countdown { /* ... */ }
        @keyframes pulse { /* ... */ }
        .benefit-card { /* ... */ }
        .icon-container { /* ... */ }
        .benefit-icon { /* ... */ }
        .testimonial { /* ... */ }
        .top-banner { /* ... */ }
        .benefits-banner { /* ... */ }
        .bottom-banner { /* ... */ }
        .security-badge { /* ... */ }
        .btn-primary { /* ... */ }
        input:focus, select:focus { /* ... */ }
        .checkbox:checked { /* ... */ }
        .pix-modal { /* ... */ }
        .pix-content { /* ... */ }
        .pix-success { /* ... */ }
        .copy-btn { /* ... */ }
        .hidden-section { /* ... */ }
        #qrcode { /* ... */ }
        #qrcode canvas { /* ... */ }
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
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
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
        <div class="container px-4 py-6">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 01-2-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Dados Protegidos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-8 flex-1">
        <!-- Banner principal -->
        <img src="https://aws-assets.kiwify.com.br/cdn-cgi/image/fit=scale-down,width=1000/aIr8nqdegLp8KtQ/img_builder_83d39bc7-7006-45eb-8c04-5c81f83424cb_73b70945391b48cc8af190b4934096fd.png" alt="Banner Principal" class="w-full mb-8 rounded-lg shadow-card">
        
        <!-- Benefits Banner -->
        <div class="benefits-banner">
            <i class="fas fa-gift mr-2"></i> SEUS BENEFÍCIOS EXCLUSIVOS
        </div>

        <!-- Features/Benefícios -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach($mainProduct->features as $feature)
                <div class="benefit-card shadow-card text-center p-6 rounded-xl bg-white">
                    <div class="icon-container text-indigo-600 text-3xl mb-3">
                        <i class="{{ 'fa '.$feature->icon }}"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $feature->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $feature->description }}</p>
                </div>
            @endforeach
        </div>

        <!-- FORMULÁRIO PRINCIPAL -->
        <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $mainProduct->id }}">

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
                                    />
                                </div>
                                @error('name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
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
                                        required
                                        value="{{ old('email') }}"
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
                                    />
                                </div>
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Upsells Section -->
                    <div class="bg-white rounded-xl shadow-elevated p-6 mb-8">
                        <h2 class="text-lg font-semibold mb-6">Você pode gostar</h2>

                        @foreach($upsells as $index => $upsell)
                            <div class="flex items-start gap-4 border rounded-xl p-4 mb-6 upsell-item"> 
                                <img src="{{ $upsell->main_banner_url }}" 
                                     alt="{{ $upsell->name }}" 
                                     class="w-16 h-16 rounded-lg object-cover">
                                
                                <div class="flex-1">
                                    <label for="upsell-{{ $upsell->id }}" class="font-medium text-sm cursor-pointer block">
                                        <input type="checkbox" 
                                               id="upsell-{{ $upsell->id }}" 
                                               name="upsells[]"
                                               value="{{ $upsell->id }}"
                                               class="mr-2 h-5 w-5 text-indigo-600 border-gray-300 rounded upsell-checkbox"
                                               data-price="{{ $upsell->price }}"
                                               data-name="{{ $upsell->name }}"
                                               {{ in_array($upsell->id, old('upsells', [])) ? 'checked' : '' }}>
                                        {{ $upsell->name }} - 
                                        <span class="font-semibold">R$ {{ number_format($upsell->price, 2, ',', '.') }}</span>
                                    </label>

                                    <p class="text-xs text-gray-500 mt-1">
                                        De <span class="line-through">R$ {{ number_format($upsell->original_price, 2, ',', '.') }}</span> 
                                        por <span class="font-semibold text-green-600">R$ {{ number_format($upsell->price, 2, ',', '.') }}</span> 
                                        ({{ $upsell->discount_percentage }}% off)
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
                            <div class="w-16 h-16 rounded-md bg-indigo-100 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-indigo-600 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-sm">{{ $mainProduct->name }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-bold text-indigo-600">R$ {{ number_format($mainProduct->price, 2, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500 line-through">
                                        R$ {{ number_format($mainProduct->original_price, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Upsells Selected -->
                        <div id="selected-upsells" class="mb-4 hidden">
                            <div class="border-t border-gray-200 my-4"></div>
                            <h4 class="font-medium text-sm mb-2">Itens adicionais:</h4>
                            <div id="upsells-list"></div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Savings -->
                        <div class="flex justify-between items-center text-sm mb-4">
                            <span class="text-gray-600">Você está economizando:</span>
                            <span id="savings-amount" class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                R$ {{ number_format($mainProduct->original_price - $mainProduct->price, 2, ',', '.') }}
                            </span>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center text-lg font-bold pt-2 border-t border-gray-200">
                            <span>Total:</span>
                            <span id="total-amount" class="text-indigo-600">
                                R$ {{ number_format($mainProduct->price, 2, ',', '.') }}
                            </span>
                        </div>

                        <!-- Pay Button -->
                        <button type="submit" id="pay-button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 mt-4 btn-primary">
                            <i class="fas fa-lock mr-2"></i>Pagar R$ {{ number_format($mainProduct->price, 2, ',', '.') }}
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

                        @foreach($mainProduct->testimonials as $testimonial)
                            <div class="flex items-start mb-6">
                                <img src="{{ $testimonial->image_url }}" 
                                     alt="{{ '@' . $testimonial->username }}" 
                                     class="w-12 h-12 rounded-full shadow-md mr-4">

                                <div>
                                    <p class="text-sm font-medium">
                                        <i class="fas fa-quote-left text-indigo-500 mr-2"></i>
                                        "{{ $testimonial->text }}"
                                    </p>
                                    <span class="text-xs text-indigo-600 mt-2 block">
                                        <i class="fas fa-user-circle mr-1"></i>{{ '@'.$testimonial->username }}
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

    <script>
        // Dados do produto principal
        const mainProduct = @json($mainProduct);

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

        // Atualização do total com upsells
        function updateTotal() {
            let total = parseFloat(mainProduct.price);
            let selectedUpsells = document.querySelectorAll('.upsell-checkbox:checked');
            let upsellsContainer = document.getElementById('selected-upsells');
            let upsellsList = document.getElementById('upsells-list');
            
            // Limpa a lista de upsells
            upsellsList.innerHTML = '';
            
            // Adiciona cada upsell selecionado
            selectedUpsells.forEach(checkbox => {
                let price = parseFloat(checkbox.getAttribute('data-price'));
                let name = checkbox.getAttribute('data-name');
                total += price;
                
                // Adiciona à lista
                let item = document.createElement('div');
                item.className = 'flex justify-between text-sm mb-1';
                item.innerHTML = `
                    <span>${name}</span>
                    <span>R$ ${price.toFixed(2).replace('.', ',')}</span>
                `;
                upsellsList.appendChild(item);
            });
            
            // Mostra ou esconde a seção de upsells
            if (selectedUpsells.length > 0) {
                upsellsContainer.classList.remove('hidden');
            } else {
                upsellsContainer.classList.add('hidden');
            }
            
            // Atualiza o total
            let totalElement = document.getElementById('total-amount');
            totalElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
            
            // Atualiza a economia
            let savingsElement = document.getElementById('savings-amount');
            let savings = parseFloat(mainProduct.original_price) - parseFloat(mainProduct.price);
            
            // Adiciona economia dos upsells (se houver)
            selectedUpsells.forEach(checkbox => {
                let upsellItem = checkbox.closest('.upsell-item');
                if (upsellItem) {
                    let originalPriceText = upsellItem.querySelector('.line-through').textContent.replace('R$ ', '').replace(',', '.');
                    let originalPrice = parseFloat(originalPriceText);
                    let discountPrice = parseFloat(checkbox.getAttribute('data-price'));
                    savings += (originalPrice - discountPrice);
                }
            });
            
            savingsElement.textContent = `R$ ${savings.toFixed(2).replace('.', ',')}`;
            
            // Atualiza o botão de pagamento
            let payButton = document.getElementById('pay-button');
            payButton.innerHTML = `<i class="fas fa-lock mr-2"></i>Pagar R$ ${total.toFixed(2).replace('.', ',')}`;
        }

        // Adiciona eventos aos checkboxes de upsell
        document.querySelectorAll('.upsell-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
        });

        // Validação do formulário antes de enviar
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const confirmEmail = document.getElementById('confirm-email').value;
            const phone = document.getElementById('phone').value;
            
            if (!name || !email || !confirmEmail || !phone) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            if (email !== confirmEmail) {
                e.preventDefault();
                alert('Os e-mails não coincidem. Por favor, verifique.');
                return;
            }
            
            // Mostrar loading no botão
            const payButton = document.getElementById('pay-button');
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processando...';
            payButton.disabled = true;
        });

        // Inicializa o total
        updateTotal();
    </script>
</body>
</html>