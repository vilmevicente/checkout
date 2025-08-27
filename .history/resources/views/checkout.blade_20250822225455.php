<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Premium</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; background: #f8fafc; }
    .shadow-card { box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
    .shadow-elevated { box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header class="bg-white border-b shadow-card">
    <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
      <div>
        <h1 class="text-2xl font-bold">Checkout</h1>
        <p class="text-gray-500 text-sm">Conclua sua compra com segurança</p>
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
    
    <!-- Formulário + Pagamento -->
    <div class="lg:col-span-2 space-y-6">
      
      <!-- Dados -->
      <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Steps -->
    <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
      <li class="flex items-center text-primary-700 dark:text-primary-500 after:mx-6 sm:after:inline-block sm:after:content-['/']">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Cart
      </li>
      <li class="flex items-center text-primary-700 dark:text-primary-500 after:mx-6 sm:after:inline-block sm:after:content-['/']">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Checkout
      </li>
      <li class="flex items-center">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Order summary
      </li>
    </ol>

    <!-- Layout -->
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
      <!-- Left: Delivery + Payment -->
      <div class="min-w-0 flex-1 space-y-8">
        <!-- Delivery -->
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery Details</h2>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium">Your name</label>
              <input type="text" class="w-full rounded-lg border-gray-300 p-2.5 text-sm" placeholder="Bonnie Green" required />
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium">Your email</label>
              <input type="email" class="w-full rounded-lg border-gray-300 p-2.5 text-sm" placeholder="name@email.com" required />
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium">Country</label>
              <select class="w-full rounded-lg border-gray-300 p-2.5 text-sm">
                <option>United States</option>
                <option>France</option>
                <option>Spain</option>
              </select>
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium">City</label>
              <select class="w-full rounded-lg border-gray-300 p-2.5 text-sm">
                <option>San Francisco</option>
                <option>New York</option>
              </select>
            </div>
            <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium">Phone</label>
              <input type="tel" class="w-full rounded-lg border-gray-300 p-2.5 text-sm" placeholder="+1 999 999 999" required />
            </div>
          </div>
        </div>

        <!-- Payment -->
        <div class="space-y-4">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Payment Method</h2>
          <div class="rounded-lg border-2 border-teal-400 bg-teal-50 p-4">
            <div class="flex items-center justify-between mb-3">
              <div>
                <h3 class="font-medium">PIX</h3>
                <p class="text-sm text-gray-600">Approval in minutes</p>
              </div>
              <span class="bg-teal-100 text-xs text-teal-800 px-2 py-1 rounded">Recommended</span>
            </div>
            <div class="flex justify-between font-bold text-lg mb-4">
              <span>Total:</span>
              <span id="pix-total" class="text-teal-600">R$ 297,00</span>
            </div>
            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-3 rounded-lg">
              Pay with PIX
            </button>
          </div>
        </div>
      </div>

      <!-- Right: Summary + Upsells -->
      <div class="mt-8 lg:mt-0 w-full max-w-md space-y-6">
        <!-- Order Summary -->
        <div class="rounded-lg border bg-white p-6 shadow">
          <h2 class="text-lg font-semibold mb-4">Order Summary</h2>
          <ul id="summary-items" class="space-y-2 mb-4">
            <li class="flex justify-between">
              <span>Curso de Marketing Digital</span>
              <span class="font-medium">R$ 297,00</span>
            </li>
          </ul>
          <div class="flex justify-between font-bold text-lg border-t pt-2">
            <span>Total</span>
            <span id="summary-total" class="text-indigo-600">R$ 297,00</span>
          </div>
        </div>

        <!-- Upsells -->
        <div class="rounded-lg border bg-white p-6 shadow space-y-4">
          <h2 class="text-lg font-semibold mb-4">Add more & save</h2>
          <label class="flex items-start gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" class="upsell mt-1" data-price="97" data-name="Instagram Ads Avançado"/>
            <div>
              <p class="font-medium">Instagram Ads Avançado</p>
              <div class="flex gap-2 text-sm">
                <span class="font-bold text-indigo-600">R$ 97,00</span>
                <span class="line-through text-gray-500">R$ 197,00</span>
              </div>
            </div>
          </label>
          <label class="flex items-start gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">
            <input type="checkbox" class="upsell mt-1" data-price="47" data-name="Templates Premium"/>
            <div>
              <p class="font-medium">Templates Premium</p>
              <div class="flex gap-2 text-sm">
                <span class="font-bold text-indigo-600">R$ 47,00</span>
                <span class="line-through text-gray-500">R$ 97,00</span>
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
  </form>
</section>

<script>
  const basePrice = 297;
  const checkboxes = document.querySelectorAll('.upsell');
  const summaryItems = document.getElementById('summary-items');
  const summaryTotal = document.getElementById('summary-total');
  const pixTotal = document.getElementById('pix-total');

  checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));

  function updateSummary() {
    summaryItems.innerHTML = `
      <li class="flex justify-between">
        <span>Curso de Marketing Digital</span>
        <span class="font-medium">${formatCurrency(basePrice)}</span>
      </li>
    `;

    let total = basePrice;

    checkboxes.forEach(cb => {
      if (cb.checked) {
        const price = parseFloat(cb.dataset.price);
        total += price;
        summaryItems.innerHTML += `
          <li class="flex justify-between text-sm text-gray-700">
            <span>+ ${cb.dataset.name}</span>
            <span>${formatCurrency(price)}</span>
          </li>
        `;
      }
    });

    summaryTotal.textContent = formatCurrency(total);
    pixTotal.textContent = formatCurrency(total);
  }

  function formatCurrency(value) {
    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
  }
</script>

    </aside>
  </main>

  <script>
    const basePrice = 297;
    const checkboxes = document.querySelectorAll('.upsell');
    const summaryItems = document.getElementById('summary-items');
    const summaryTotal = document.getElementById('summary-total');
    const pixTotal = document.getElementById('pix-total');

    checkboxes.forEach(cb => cb.addEventListener('change', updateSummary));

    function updateSummary() {
      summaryItems.innerHTML = `
        <li class="flex justify-between">
          <span class="text-sm">Curso Completo de Marketing Digital</span>
          <span class="font-medium">${formatCurrency(basePrice)}</span>
        </li>
      `;

      let total = basePrice;

      checkboxes.forEach(cb => {
        if (cb.checked) {
          const price = parseFloat(cb.dataset.price);
          total += price;
          summaryItems.innerHTML += `
            <li class="flex justify-between text-sm text-gray-700">
              <span>+ ${cb.dataset.name}</span>
              <span>${formatCurrency(price)}</span>
            </li>
          `;
        }
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
