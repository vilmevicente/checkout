<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Acesso ao Produto</title>
</head>
<body>
    <h1>Olá, {{ $customerName }}!</h1>
    <p>Obrigado por adquirir o produto: <strong>{{ $product->name }}</strong></p>
    
    @if($deliveryContent)
    <div>
        {!! $deliveryContent !!}
    </div>
    @endif
    
    @if($product->attachments && $product->attachments->count() > 0)
    <h3>Anexos incluídos:</h3>
    <ul>
        @foreach($product->attachments as $attachment)
        <li>
            <strong>{{ $attachment->name }}</strong> 
            @if($attachment->file_size)
            ({{ $attachment->formatted_size }})
            @endif
        </li>
        @endforeach
    </ul>
    @endif
    
    <p>Atenciosamente,<br>Equipe {{ config('app.name') }}</p>
</body>
</html>
