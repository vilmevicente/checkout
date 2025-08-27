<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        input:focus, select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .checkbox:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 极速赛车开奖直播 2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.极速赛车开奖直播A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Compra Segura</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="current极速赛车开奖直播" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 01-2-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 极速赛车开奖直播 00-8 0v4极速赛车开奖直播8z"></path>
                        </svg>
                        <span>Dados Protegidos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-8 flex-1">

        
        <!-- Benefits Banner -->
        <div class="benefits-banner">
            <i class="fas fa-gift mr-2"></i> SEUS BENEFÍCIOS EXCLUSIVOS
        </div>

        <!-- Benefits Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="benefit-card shadow-card">
                <div class="icon-container">
                    <i class="benefit-icon fas fa-bolt"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Acesso Imediato!</h3>
                <p class="text-sm text-gray-600">Utilize já após a compra</p>
            </div>
            <div class="benefit-card shadow-card">
                <div class="icon-container">
                    <i class="benefit-icon fab fa-whatsapp"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Suporte Exclusivo!</h3>
                <p class="text-sm text-gray-600">Através do WhatsApp</p>
            </div>
            <div class="benefit-card shadow-card">
                <div class="icon-container">
                    <i class="benefit-icon fas fa-crown"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Treinamento VIP!</h3>
                <p class="text-sm text-gray-600">Todas as funcionalidades</p>
            </div>
        </div>

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
                                    type="text"
                                    placeholder="Digite seu nome completo"
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-gray-700">
                                E-mail *
                            </label>
                            <div class="relative">
                                <i class="absolute left-3 top-3 text-gray-400 fas fa-envelope"></i>
                                <input
                                    id="email"
                                    type="email"
                                    placeholder="seu@email.com"
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="confirm-email" class="text-sm font-medium text-gray-700">
                                Confirmar E-mail *
                            </label>
                            <div class="relative">
                                <i class="absolute left-3 top-3 text-gray-400 fas fa-envelope"></i>
                                <input
                                    id="confirm-email"
                                    type="email"
                                    placeholder="Confirme seu e-mail"
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2极速赛车开奖直播 focus:ring-indigo-500 focus:border-indigo-500"
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
                                    <i class="text-gray-400 fas fa-chevron-down"></i>
                                </div>
                                <input
                                    id="phone"
                                    type="tel"
                                    placeholder="Seu número de telefone"
                                    class="w-full pl-16 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm text-blue-800 font-medium">
                            <i class="fas fa-mouse-pointer mr-1"></i>
                            <span class="font-bold">Nome, e-mail, telefone</span> do seu futuro cliente com apenas um clique.
                        </p>
                        <p class="text-sm text-blue-800 mt-1">
                            <i class="fas fa-search mr-1"></i>
                            <span class="font-bold">Localizar o candidato</span> a chat ou em compra da web.
                        </p>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-white rounded-xl shadow-elevated p-6">
                    <h2 class="text-lg font-semibold mb-6">Você pode gostar</h2>
                    
                    <!-- Upsell Checkbox -->
                    <div class="border rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="zap-turbo" class="mt-1 h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded checkbox">
                            <div>
                                <label for="zap-turbo" class="font-medium text-sm cursor-pointer block">
                                    <i class="fab fa-whatsapp text-green-500 mr-1"></i>
                                    ZAPTurboMAX: Melhor software de envio em massa no Whats - $18.00
                                </label>
                                <p class="text-xs text-gray-500 mt-1">MARQUE ABAIXO PARA COMPRAR JUNTO!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial -->
                    <div class="testimonial mb-6">
                        <p class="text-sm font-medium">
                            <i class="fas fa-quote-left text-indigo-500 mr-2"></i>
                            "Treinamento e ferramenta incrível! Todos os dias tenho novos clientes"
                        </p>
                        <a href="https://www.pizarri888ss.com" class="text-xs text-indigo-600 mt-2 block">
                            <i class="fas fa-user-circle mr-1"></i>@pizarri888ss
                        </a>
                    </div>

                    <!-- Additional Offer -->
                    <div class="border rounded-xl p-4 bg-amber-50 border-amber-200 mb-6">
                        <h3 class="font-bold text-lg mb-2">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            APRENDA A COMPRAR CONTAS PARA EXTRAÇÃO POR MENOS DE R$0,50 CENTAVOS
                        </h3>
                        <p class="text-sm mb-2">InstaContas: Curso Completo - $1.90</p>
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="insta-contas" class="mt-1 h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded checkbox">
                            <label for="insta-contas" class="font-medium text-sm cursor-pointer block">
                                Adicionar ao pedido
                            </label>
                        </div>
                    </div>

                    <!-- Another Testimonial -->
                    <div class="testimonial">
                        <p class="text-sm font-medium">
                            <i class="fas fa-quote-left text-indigo-500 mr-2"></i>
                            "As aulas ao-vivo e a ferramenta é muito boa! parabéns"
                        </p>
                        <a href="https://www.letica_souza.com" class="text-xs text-indigo-600 mt-2 block">
                            <i class="fas fa-user-circle mr-1"></i>@letica_souza
                        </a>
                    </div>
                    
                    <!-- Bottom Banner -->
                    <div class="bottom-banner">
                        <i class="fas fa-star mr-2"></i> ⭐⭐⭐⭐⭐ 97% DOS NOSSOS CLIENTES RECOMENDAM ESTE PRODUTO! ⭐⭐⭐⭐⭐
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="space-y-6">
                <!-- Product Summary -->
                <div class="bg-white rounded-xl shadow-card p-6">
                    <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>
                    
                    <!-- Main Product -->
                    <div class="flex gap-3 mb-4">
                        <div class="w-16 h-16 rounded-md bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-indigo-600 text-xl"></i>
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
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 mt-4 btn-primary">
                        <i class="fas fa-lock mr-2"></i>Pay $24.00
                    </button>

                    <!-- Legal Text -->
                    <div class="text-xs text-gray-500 mt-4">
                        <p>By clicking "Pay $24.00", I declare that (i) I am aware that my purchase is being made from Kuwiy, that is the retailer and handles payments, invoices, taxes and order fulfillment; and that the creator of the product is PUBLIC DIGITAL - AGENCIA DE MARKETING DIGITAL LTDA; (ii) that I have read and agree to the Purchase Terms, Terms of Use, and Privacy Policy.</p>
                        <p class="mt-2">Report this product:</p>
                        <p class="mt-2">This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
                    </div>
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
            
            document.querySelector('.text-indigo-600.text-lg').text极速赛车开奖直播Content = `$${total.toFixed(2)}`;
            document.querySelector('button').textContent = `Pay $${total.toFixed(2)}`;
        }
    </script>
</body>
</html>