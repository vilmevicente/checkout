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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

    .container {
  max-width: 1280px !important;
  margin: 0 auto;
  padding-left: 1rem;
  padding-right: 1rem;
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
        
        .countdown {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }
        
        .benefit-card {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }
        
        .testimonial {
            background: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            border-left: 4px solid #4f46e5;
        }
        
        .top-banner {
            background: linear-gradient(90deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            text-align: center;
            padding: 12px;
            font-weight: 600;
        }
        
        .bottom-banner {
            background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
            color: white;
            text-align: center;
            padding: 14px;
            margin-top: 20px;
            border-radius: 8px;
            font-weight: 600;
        }
    </style>
</head>
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
        <!-- Benefits Banner -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="benefit-card">
                <h3 class="font-bold text-lg">Acesso imediato!</h3>
                <p class="text-sm">Utilize já após a compra</p>
            </div>
            <div class="benefit-card">
                <h3 class="font-bold text-lg">Suporte Exclusivo!</h3>
                <p class="text-sm">Através do WhatsApp</p>
            </div>
            <div class="benefit-card">
                <h3 class="font-bold text-lg">Treinamento VIP!</h3>
                <p class="text-sm">Todas as funcionalidades</p>
            </div>
        </div>

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
                            <label for="phone" class="text-sm font-medium text-gray-700">
                                Telefone *
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-3 flex items-center">
                                    <span class="text-gray-400 mr-1">+244</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <input
                                    id="phone"
                                    type="tel"
                                    placeholder="Seu número de telefone"
                                    class="w-full pl-16 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>
                    </div>

                    
                </div>

                <!-- Payment Section -->
                <div class="bg-white rounded-lg shadow-elevated p-6">
                    <h2 class="text-lg font-semibold mb-6">Forma de Pagamento</h2>
                    
                    

                    <div class="text-xs text-gray-500 text-center mb-4">
                        We protect your payment data with encryption to ensure bank-level security.
                    </div>

                    <!-- Upsell Checkbox -->
                    <div class="border rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="zap-turbo" class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <div>
                                <label for="zap-turbo" class="font-medium text-sm cursor-pointer block">
                                    ZAPTurboMAX: Melhor software de envio em massa no Whats - $18.00
                                </label>
                                <p class="text-xs text-gray-500 mt-1">MARQUE ABAIXO PARA COMPRAR JUNTO!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial -->
                    <div class="testimonial mb-6">
                        <p class="text-sm font-medium">"Treinamento e ferramenta incrível! Todos os dias tenho novos clientes"</p>
                        <a href="https://www.pizarri888ss.com" class="text-xs text-indigo-600 mt-2 block">@pizarri888ss</a>
                    </div>

                    <!-- Additional Offer -->
                    <div class="border rounded-lg p-4 bg-amber-50 border-amber-200 mb-6">
                        <h3 class="font-bold text-lg mb-2">APRENDA A COMPRAR CONTAS PARA EXTRAÇÃO POR MENOS DE R$0,50 CENTAVOS</h3>
                        <p class="text-sm mb-2">InstaContas: Curso Completo - $1.90</p>
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="insta-contas" class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="insta-contas" class="font-medium text-sm cursor-pointer block">
                                Adicionar ao pedido
                            </label>
                        </div>
                    </div>

                    <!-- Another Testimonial -->
                    <div class="testimonial">
                        <p class="text-sm font-medium">"As aulas ao-vivo e a ferramenta é muito boa! parabéns"</p>
                        <a href="https://www.letica_souza.com" class="text-xs text-indigo-600 mt-2 block">@letica_souza</a>
                    </div>
                    
                    <!-- Bottom Banner -->
                    <div class="bottom-banner">
                        ⭐⭐⭐⭐⭐ 97% DOS NOSSOS CLIENTES RECOMENDAM ESTE PRODUTO! ⭐⭐⭐⭐⭐
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
                                <span class="font-bold text-indigo-600">$24.00</span>
                                <span class="text-sm text-gray-500 line-through">
                                    $97.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <!-- Savings -->
                    <div class="flex justify-between items-center text-sm mb-4">
                        <span class="text-gray-600">Você está economizando:</span>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            $73.00
                        </span>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center text-lg font-bold pt-2 border-t border-gray-200">
                        <span>Total:</span>
                        <span class="text-indigo-600">$24.00</span>
                    </div>

                    <!-- Pay Button -->
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-md transition duration-200 mt-4">
                        Pay $24.00
                    </button>

                    <!-- Legal Text -->
                    <div class="text-xs text-gray-500 mt-4">
                        <p>By clicking "Pay $24.00", I declare that (i) I am aware that my purchase is being made from Kuwiy, that is the retailer and handles payments, invoices, taxes and order fulfillment; and that the creator of the product is PUBLIC DIGITAL - AGENCIA DE MARKETING DIGITAL LTDA; (ii) that I have read and agree to the Purchase Terms, Terms of Use, and Privacy Policy.</p>
                        <p class="mt-2">Report this product:</p>
                        <p class="mt-2">This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
                    </div>
                </div>

                <!-- Security Badges -->
                <div class="bg-white rounded-lg shadow-card p-6">
                    <h2 class="text-lg font-semibold mb-4">Segurança</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col items-center justify-center p-3 border rounded-lg">
                            <svg class="w-8 h-8 text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 极速赛车开奖直播 极速赛车开奖直播 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-xs text-center">Compra 100% Segura</span>
                        </div>
                        <div class="flex flex-col items-center justify-center p-3 border rounded-lg">
                            <svg class="w-8 h-8 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-极速赛车开奖直播 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v极速赛车开奖直播a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="text-xs text-center">Dados Criptografados</span>
                        </div>
                    </div>
                </div>
            </div>
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
            
            let minutes = Math.floor((极速赛车开奖直播 % (1000 * 60 * 60)) / (1000 * 60));
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
            
            if (email !== confirmEmail) {
                e.target.classList.add('border-red-500');
                // Aqui você pode adicionar uma mensagem de erro
            } else {
                e.target.classList.remove('border-red-500');
            }
        });

        // Simulação de seleção de upsells
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateTotal();
            });
        });

        function updateTotal() {
            // Lógica para atualizar o total quando upsells são selecionados
            let total = 24.00; // Preço base
            
            if (document.getElementById('zap-turbo').checked) {
                total += 18.00;
            }
            
            if (document.getElementById('insta-contas').checked) {
                total += 1.90;
            }
            
            document.querySelector('.text-indigo-600.text-lg').textContent = `$${total.toFixed(2)}`;
            document.querySelector('button').textContent = `Pay $${total.toFixed(2)}`;
        }
    </script>
</body>
</html>