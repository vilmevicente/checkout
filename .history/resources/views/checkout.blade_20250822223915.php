<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
    .shadow-card {
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .shadow-elevated {
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header class="bg-white border-b shadow-card">
    <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
      <div>
        <h1 class="text-2xl font-bold">Finalizar Compra</h1>
        <p class="text-gray-500 text-sm">Complete seus dados para continuar</p>
      </div>
      <div class="flex items-center gap-6 text-sm text-gray-600 mt-4 md:mt-0">
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
          <span>Compra Segura</span>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          <span>Dados Protegidos</span>
        </div>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-10 grid lg:grid-cols-3 gap-8">
    
    <!-- Left: Form + Pagamento -->
    <div class="lg:col-span-2 space-y-6">
      
      <!-- Dados -->
      <section class="bg-white rounded-lg shadow-card p-6">
        <h2 class="text-lg font-semibold mb-6 flex items-center gap-2">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
          Seus Dados
        </h2>

        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="text-sm font-medium text-gray-700">Nome Completo *</label>
            <input type="text" placeholder="Digite seu nome completo"
              class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500"/>
          </div>
          <div>
            <label class="text-sm font-medium text-gray-700">E-mail *</label>
            <input type="email" placeholder="seu@email.com"
              class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500"/>
          </div>
          <div>
            <label class="text-sm font-medium text-gray-700">Telefone *</label>
            <input id="phone" type="tel" placeholder="(11) 99999-9999"
              class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500"/>
          </div>
          <div>
            <label class="text-sm font-medium text-gray-700">CPF *</label>
            <input id="document" type="text" placeholder="000.000.000-00"
              class="w-full mt-1 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500"/>
          </div>
        </div>
      </section>

      <!-- Pagamento -->
      <section class="bg-white rounded-lg shadow-elevated p-6">
        <h2 class="text-lg font-semibold mb-6">Forma de Pagamento</h2>

        <div class="border-2 border-teal-400 rounded-lg p-4 bg-teal-50">
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-3">
              <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
              </svg>
              <div>
                <h3 class="font-semibold">PIX</h3>
                <p class="text-sm text-gray-600">Aprovação imediata</p>
              </div>
            </div>
            <span class="bg-teal-100 text-teal-800 text-xs px-2 py-1 rounded">Recomendado</span>
          </div>
          <div class="flex justify-between text-lg font-bold mb-4">
            <span>Total:</span>
            <span id="pix-total" class="text-teal-600">R$ 297,00</span>
          </div>
          <button class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 rounded-md transition">
            Pagar com PIX
          </button>
        </div>
        <p class="text-xs text-gray-500 text-center mt-3">
          Ao finalizar a compra, você concorda com os termos de uso e política de privacidade.
        </p>
      </section>
    </div>

    <!-- Right: Resumo + Upsell -->
    <aside class="space-y-6">
      <!-- Resumo -->
      <section class="bg-white rounded-lg shadow-card p-6">
        <h2 class="text-lg font-semibold mb-4">Resumo do Pedido</h2>
        <div class="flex gap-3 mb-4">
          <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">📘</div>
          <div>
            <h3 class="font-medium">Curso Completo de Marketing Digital</h3>
            <div class="flex gap-2">
              <span class="font-bold text-indigo-600">R$ 297,00</span>
              <span class="text-gray-500 line-through">R$ 497,00</span>
            </div>
          </div>
        </div>
        <div class="flex justify-between text-sm mb-2">
          <span>Você está economizando:</span>
          <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded">R$ 200,00</span>
        </div>
        <div class="flex justify-between text-lg font-bold border-t pt-2">
          <span>Total:</span>
          <span id="summary-total" class="text-indigo-600">R$ 297,00</span>
        </div>
      </section>

      <!-- Upsell -->
      <section class="bg-white rounded-lg shadow-card p-6">
        <h2 class="text-lg font-semibold mb-4">Adicione e Economize Mais</h2>
        <div class="space-y-4">
          <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" class="upsell mt-1" data-price="97"/>
            <div class="flex-1">
              <p class="font-medium">Módulo Bônus: Instagram Ads Avançado</p>
              <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
              <div class="flex gap-2 mt-1">
                <span class="font-bold text-indigo-600">R$ 97,00</span>
                <span class="line-through text-gray-500">R$ 197,00</span>
              </div>
            </div>
          </label>
          <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" class="upsell mt-1" data-price="47"/>
            <div class="flex-1">
              <p class="font-medium">Templates Premium para Redes Sociais</p>
              <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded">52% OFF</span>
              <div class="flex gap-2 mt-1">
                <span class="font-bold text-indigo-600">R$ 47,00</span>
                <span class="line-through text-gray-500">R$ 97,00</span>
              </div>
            </div>
          </label>
          <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" class="upsell mt-1" data-price="197"/>
            <div class="flex-1">
              <p class="font-medium">Consultoria 1:1 (30min)</p>
              <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded">50% OFF</span>
              <div class="flex gap-2 mt-1">
                <span class="font-bold text-indigo-600">R$ 197,00</span>
                <span class="line-through text-gray-500">R$ 397,00</span>
              </div>
            </div>
          </label>
        </div>
      </section>
    </aside>
  </main>

  <script>
    const basePrice = 297;
    const checkboxes = document.querySelectorAll('.upsell');
    const summaryTotal = document.getElementById('summary-total');
    const pixTotal = document.getElementById('pix-total');

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));

    function updateTotal() {
      let total = basePrice;
      checkboxes.forEach(cb => {
        if (cb.checked) total += parseFloat(cb.dataset.price);
      });
      summaryTotal.textContent = formatCurrency(total);
      pixTotal.textContent = formatCurrency(total);
    }

    function formatCurrency(value) {
      return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }
  </script>
</body>
</html>
