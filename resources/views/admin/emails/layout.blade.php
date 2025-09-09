<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Confirmação de Pedido' }}</title>
    <style>
        /* Reset CSS para compatibilidade entre clientes de email */
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        /* Estilos principais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
            width: 100% !important;
            height: 100% !important;
        }
        .email-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 0;
            margin: 20px auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
        }
        .email-header {
            background-color: #4f46e5;
            padding: 25px 25px 20px;
            color: white;
            text-align: center;
        }
        .email-body {
            padding: 25px;
        }
        h1 {
            color: #ffffff;
            font-size: 24px;
            margin: 0 0 10px;
            font-weight: bold;
        }
        h2 {
            margin-top: 25px;
            font-size: 18px;
            color: #222;
            font-weight: bold;
            padding-bottom: 8px;
            border-bottom: 2px solid #f0f0f0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 15px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .order-details th, .order-details td {
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
        }
        .order-details th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .total {
            font-weight: bold;
            color: #111;
            font-size: 18px;
            text-align: right;
            padding-top: 15px;
        }
        .pix-box {
            margin-top: 20px;
            padding: 20px;
            background: #f0f9f0;
            border: 1px solid #b6e2b6;
            border-radius: 6px;
        }
        .pix-code {
            background: #ffffff;
            padding: 15px;
            border-radius: 4px;
            border: 1px dashed #ccc;
            word-break: break-all;
            font-family: monospace;
            font-size: 14px;
            margin: 10px 0;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
            padding: 20px;
            background-color: #f8f8f8;
            border-top: 1px solid #eee;
        }
        .highlight {
            color: #4f46e5;
            font-weight: bold;
        }
        /* Responsividade */
        @media only screen and (max-width: 640px) {
            .email-container {
                width: 100% !important;
                border-radius: 0;
                margin: 0;
            }
            .email-body {
                padding: 15px;
            }
            h1 {
                font-size: 20px;
            }
            h2 {
                font-size: 16px;
            }
            .order-details th, .order-details td {
                padding: 8px 5px;
                font-size: 14px;
            }
            .order-details table {
                font-size: 14px;
            }
            .pix-code {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <center class="container">
    {{-- Aqui injetamos o conteúdo salvo no DB --}}
    {!! $content !!}
</center>
</body>
</html>
