{{-- resources/views/emails/order-confirmation.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação do Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4f46e5;
            font-size: 20px;
        }
        h2 {
            margin-top: 25px;
            font-size: 16px;
            color: #222;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .order-details th, .order-details td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .total {
            font-weight: bold;
            color: #111;
        }
        .pix-box {
            margin-top: 20px;
            padding: 15px;
            background: #f0f9f0;
            border: 1px solid #b6e2b6;
            border-radius: 6px;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmação do Pedido #{{ $order->reference }}</h1>
        <p>Olá <strong>{{ $order->customer_name }}</strong>,</p>
        <p>Obrigado pela sua compra! Recebemos o seu pedido e já estamos a processá-lo.</p>

        <div class="order-details">
            <h2>Produto Principal:</h2>
            @if($order->mainProduct())
                <p><strong>{{ $order->mainProduct()->product->name }}</strong></p>
                <p>Preço: R$ {{ number_format($order->mainProduct()->price, 2, ',', '.') }}</p>
            @endif

            @if($order->upsells()->count() > 0)
                <h2>Produtos Adicionais:</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->upsells() as $upsell)
                            <tr>
                                <td>{{ $upsell->product->name }}</td>
                                <td>{{ $upsell->quantity }}</td>
                                <td>R$ {{ number_format($upsell->price, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <h2>Total:</h2>
            <p class="total">R$ {{ number_format($order->total, 2, ',', '.') }}</p>
        </div>

        @if($order->payment_method === 'pix')
            <div class="pix-box">
                <h2>Pagamento via PIX</h2>
                <p><strong>Código PIX:</strong></p>
                <pre>{{ $order->pix_code }}</pre>
                @if($order->pix_expires_at)
                    <p><strong>Expira em:</strong> {{ $order->pix_expires_at->format('d/m/Y H:i') }}</p>
                @endif
            </div>
        @endif

        <div class="footer">
            <p>Se tiver alguma dúvida, entre em contacto com a nossa equipa.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
