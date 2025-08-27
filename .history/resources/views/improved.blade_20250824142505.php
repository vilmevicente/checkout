<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f3f4f6;
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
  </style>
</head>
<body>

  <!-- 🔹 Banner topo -->
  <div class="w-full">
    <img src="https://via.placeholder.com/1200x120?text=Banner+Topo" alt="Banner Topo" class="w-full">
  </div>

  <!-- Barra de contagem regressiva -->
  <div class="countdown text-white text-center py-3 px-4 font-bold">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-2">
      <span>OFERTA RELÂMPAGO!</span>
      <span>Seu desconto expira em: </span>
      <div id="countdown-timer">
        <span class="bg-white text-red-600 px-2 py-1 rounded font-mono">15:00</span>
      </div>
    </div>
  </div>

  <!-- Cabeçalho -->
  <div class="bg-white border-b shadow">
    <div class="max-w-5xl mx-auto px-4 py-6">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Finalizar Compra</h1>
          <p class="text-gray-600 mt-1">Complete seus dados para continuar</p>
        </div>
        <div class="flex items-center gap-4 text-sm text-gray-600 mt-4 md:mt-0">
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <span>Compra Segura</span>
          </div>
          <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 01-2-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            <span>Dados Protegidos</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Conteúdo principal -->
  <div class="max-w-5xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
      
      <!-- Coluna esquerda (forms + upsell) -->
      <div class="lg:col-span-2 space-y-6">
        <!-- ... seu formulário e blocos de pagamento continuam aqui ... -->
      </div>

      <!-- Coluna direita (resumo + segurança) -->
      <div class="space-y-6">
        <!-- ... resumo e badges de segurança ... -->

        <!-- 🔹 Banner após "compra segura" -->
        <div class="w-full">
          <img src="https://via.placeholder.com/400x200?text=Banner+Segurança" alt="Banner Segurança" class="rounded-lg shadow w-full">
        </div>
      </div>
    </div>
  </div>

  <script>
    // Timer regressivo
    let time = 900;
    const timerEl = document.getElementById('countdown-timer');
    setInterval(() => {
      let min = String(Math.floor(time / 60)).padStart(2,'0');
      let sec = String(time % 60).padStart(2,'0');
      timerEl.innerHTML = `<span class="bg-white text-red-600 px-2 py-1 rounded font-mono">${min}:${sec}</span>`;
      time--;
    }, 1000);
  </script>
</body>
</html>
