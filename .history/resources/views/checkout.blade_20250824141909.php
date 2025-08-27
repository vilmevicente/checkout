<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: #0f111a;
      font-family: 'Inter', sans-serif;
    }
    .countdown {
      background: linear-gradient(90deg, #22c55e, #16a34a);
    }
    .benefit-card {
      background: #111827;
      color: #fff;
      border-radius: 10px;
    }
    .upsell {
      border: 2px dashed #22c55e;
      background: #f9fafb;
    }
    .testimonial {
      background: #111827;
      border-radius: 10px;
      padding: 16px;
      color: #fff;
    }
  </style>
</head>
<body class="text-gray-100">

  <!-- Barra do topo -->
  <div class="countdown text-center py-2 font-semibold text-white">
    Só falta 1 passo! ⏰ Expira em <span id="timer">15:00</span>
  </div>

  <!-- Banner -->
  <div class="w-full">
    <img src="https://via.placeholder.com/1200x250?text=Seu+Banner+Aqui" alt="Banner" class="w-full">
  </div>

  <div class="container mx-auto px-4 py-6 grid lg:grid-cols-3 gap-8">

    <!-- Coluna esquerda (form + upsells) -->
    <div class="lg:col-span-2 space-y-6">

      <!-- Benefícios -->
      <div class="grid md:grid-cols-3 gap-4">
        <div class="benefit-card text-center p-4">
          📲 <p class="font-bold">Acesso imediato</p>
          <p class="text-sm">Use logo após a compra</p>
        </div>
        <div class="benefit-card text-center p-4">
          💬 <p class="font-bold">Suporte exclusivo</p>
          <p class="text-sm">Via WhatsApp</p>
        </div>
        <div class="benefit-card text-center p-4">
          🎯 <p class="font-bold">Treinamento VIP</p>
          <p class="text-sm">Funcionalidades completas</p>
        </div>
      </div>

      <!-- Formulário -->
      <div class="bg-white rounded-lg p-6 text-gray-800">
        <h2 class="font-bold mb-4">Seus Dados</h2>
        <input type="text" placeholder="Nome completo" class="w-full border rounded p-2 mb-3">
        <input type="email" placeholder="E-mail" class="w-full border rounded p-2 mb-3">
        <input type="email" placeholder="Confirmar e-mail" class="w-full border rounded p-2 mb-3">
        <input type="tel" placeholder="+244 Telefone" class="w-full border rounded p-2 mb-3">
      </div>

      <!-- Pagamento -->
      <div class="bg-white rounded-lg p-6 text-gray-800">
        <h2 class="font-bold mb-4">Pagamento</h2>
        <input type="text" placeholder="Número do cartão" class="w-full border rounded p-2 mb-3">
        <div class="grid grid-cols-3 gap-2 mb-3">
          <input type="text" placeholder="MM" class="border rounded p-2">
          <input type="text" placeholder="AA" class="border rounded p-2">
          <input type="text" placeholder="CVC" class="border rounded p-2">
        </div>
      </div>

      <!-- Upsell 1 -->
      <div class="upsell rounded-lg p-4">
        <label class="flex items-start gap-2">
          <input type="checkbox" class="mt-1">
          <span>
            <span class="font-bold text-green-600">ZAPTurboMAX</span> — Melhor software de envio em massa no WhatsApp <b>$18.00</b>  
            <p class="text-xs text-gray-600">✅ Marque para adicionar ao pedido</p>
          </span>
        </label>
      </div>

      <!-- Upsell 2 -->
      <div class="upsell rounded-lg p-4">
        <label class="flex items-start gap-2">
          <input type="checkbox" class="mt-1">
          <span>
            <span class="font-bold text-purple-600">InstaContas</span> — Curso completo <b>$1.90</b>  
            <p class="text-xs text-gray-600">✅ Aprenda a comprar contas por menos de R$0,50</p>
          </span>
        </label>
      </div>

      <!-- Botão -->
      <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold">
        Pay $24.00
      </button>

    </div>

    <!-- Coluna direita (Resumo + Depoimentos) -->
    <div class="space-y-6">

      <!-- Resumo do pedido -->
      <div class="bg-white rounded-lg p-6 text-gray-800">
        <h2 class="font-bold mb-4">Resumo do Pedido</h2>
        <p class="text-sm">Curso Completo de Marketing Digital</p>
        <div class="flex items-center gap-2 mt-2">
          <span class="font-bold text-green-600">$24.00</span>
          <span class="text-sm line-through text-gray-500">$97.00</span>
        </div>
        <div class="mt-2 text-sm text-gray-600">Você economiza <b>$73.00</b></div>
      </div>

      <!-- Testemunhos -->
      <div class="testimonial">
        ⭐⭐⭐⭐⭐
        <p>"Treinamento e ferramenta incrível! Todos os dias tenho novos clientes"</p>
        <span class="text-sm text-gray-400">@pizarri88zs</span>
      </div>
      <div class="testimonial">
        ⭐⭐⭐⭐⭐
        <p>"As aulas ao vivo e a ferramenta são muito boas! Parabéns"</p>
        <span class="text-sm text-gray-400">@leticia_souza</span>
      </div>

    </div>
  </div>

  <script>
    // Timer regressivo 15min
    let time = 900;
    const timerEl = document.getElementById('timer');
    setInterval(() => {
      let min = String(Math.floor(time / 60)).padStart(2,'0');
      let sec = String(time % 60).padStart(2,'0');
      timerEl.textContent = `${min}:${sec}`;
      time--;
    }, 1000);
  </script>
</body>
</html>
