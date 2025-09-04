<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Confirmação de Pedido' }}</title>
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
        h1 { color: #4f46e5; font-size: 20px; }
        h2 { margin-top: 25px; font-size: 16px; color: #222; }
        .order-details table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .order-details th, .order-details td { text-align: left; padding: 10px; border-bottom: 1px solid #eee; }
        .total { font-weight: bold; color: #111; }
        .pix-box { margin-top: 20px; padding: 15px; background: #f0f9f0; border: 1px solid #b6e2b6; border-radius: 6px; }
        .footer { margin-top: 30px; font-size: 12px; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        {{-- Aqui injetamos o conteúdo salvo no DB --}}
        {!! Blade::render($content, $data) !!}
    </div>
</body>
</html>
