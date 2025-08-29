@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<div x-data="{
    deleteProduct(id, name) {
        if (confirm(`Tem certeza que deseja excluir o produto '${name}'?`)) {
            document.getElementById('delete-form-' + id).submit();
        }
    },
    duplicateProduct(id, name) {
        if (confirm(`Tem certeza que deseja duplicar o produto '${name}'?`)) {
            document.getElementById('duplicate-form-' + id).submit();
        }
    }
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Produtos</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i> Novo Produto
        </a>
    </div>

    @if($products->isEmpty())
    <div class="bg-white rounded-lg shadow p-6 text-center">
        <i class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">Nenhum produto cadastrado ainda.</p>
        <a href="{{ route('admin.products.create') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
            Criar Primeiro Produto
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            @if($product->main_banner)
            <img src="/storage/{{ $product->main_banner }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <i class="fas fa-image text-4xl text-gray-400"></i>
            </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                
                <div class="flex items-center mb-3">
                    <span class="text-2xl font-bold text-blue-600">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </span>
                    @if($product->original_price)
                    <span class="ml-2 text-sm text-gray-500 line-through">
                        R$ {{ number_format($product->original_price, 2, ',', '.') }}
                    </span>
                    @endif
                </div>

                <p class="text-gray-600 mb-4 line-clamp-2">{{ $product->description }}</p>

                <div class="flex justify-between items-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                    </span>

                   <div class="flex items-center justify-end space-x-2">
    <!-- Visualizar Checkout -->
    <a href="{{ route('checkout', $product->slug) }}"  target="_blank"
       class="action-btn bg-green-100 text-green-700 hover:bg-green-200"
       title="Visualizar Checkout">
        <i class="fas fa-eye"></i>
        <span class="tooltip">Visualizar Checkout</span>
    </a>

    <!-- Editar Produto -->
    <a href="{{ route('admin.products.edit', $product) }}" 
       class="action-btn bg-blue-100 text-blue-700 hover:bg-blue-200"
       title="Editar Produto">
        <i class="fas fa-edit"></i>
        <span class="tooltip">Editar Produto</span>
    </a>

    <!-- Duplicar Produto -->
    <button @click="duplicateProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" 
            class="action-btn bg-indigo-100 text-indigo-700 hover:bg-indigo-200"
            title="Duplicar Produto">
        <i class="fas fa-copy"></i>
        <span class="tooltip">Duplicar Produto</span>
    </button>
    
    <!-- Excluir Produto -->
    <button @click="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" 
            class="action-btn bg-red-100 text-red-700 hover:bg-red-200"
            title="Excluir Produto">
        <i class="fas fa-trash"></i>
        <span class="tooltip">Excluir Produto</span>
    </button>
</div>

                </div>

                @if($product->upsells->count() > 0)
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600 mb-2">
                        <i class="fas fa-tags mr-1"></i> {{ $product->upsells->count() }} upsell(s)
                    </p>
                </div>
                @endif

                @if($product->deliveryMethods->count() > 0)
                <div class="mt-2 pt-2 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-truck mr-1"></i> 
                        {{ $product->deliveryMethods->count() }} método(s) entrega
                    </p>
                </div>
                @endif

                @if($product->attachments->count() > 0)
                <div class="mt-2 pt-2 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-paperclip mr-1"></i> 
                        {{ $product->attachments->count() }} anexo(s)
                    </p>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.fa-edit, .fa-copy, .fa-trash {
    font-size: 1.1rem;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.text-blue-500:hover, .text-indigo-500:hover, .text-red-500:hover {
    transform: scale(1.2);
    transition: transform 0.2s ease-in-out;
}

.flex.space-x-3 a,
.flex.space-x-3 button {
    opacity: 1 !important;
    visibility: visible !important;
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    min-height: 24px;
}

.text-blue-500 {
    color: #3b82f6 !important;
}

.text-indigo-500 {
    color: #6366f1 !important;
}

.text-red-500 {
    color: #ef4444 !important;
}

.text-blue-500:hover {
    color: #2563eb !important;
}

.text-indigo-500:hover {
    color: #4f46e5 !important;
}

.text-red-500:hover {
    color: #dc2626 !important;
}

.bg-green-50 {
    background-color: #f0fdf4;
}

.bg-blue-50 {
    background-color: #eff6ff;
}

.bg-gray-50 {
    background-color: #f9fafb;
}

.border-green-200 {
    border-color: #bbf7d0;
}

.border-blue-200 {
    border-color: #bfdbfe;
}

.border-gray-200 {
    border-color: #e5e7eb;
}
   /* Estilos para os botões */
    .flex.space-x-2 > * {
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
    }

    .flex.space-x-2 > *:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Tooltips */
    .group .tooltip {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s, visibility 0.2s;
        z-index: 1000;
    }

    .group .tooltip::after {
        content: '';
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 5px 5px 5px;
        border-style: solid;
        border-color: transparent transparent #333 transparent;
    }

    .group:hover .tooltip {
        opacity: 1;
        visibility: visible;
    }

    /* Efeitos específicos para cada botão */
    .bg-green-100:hover { background-color: #dcfce7 !important; }
    .bg-blue-100:hover { background-color: #dbeafe !important; }
    .bg-indigo-100:hover { background-color: #e0e7ff !important; }
    .bg-red-100:hover { background-color: #fee2e2 !important; }

    /* Responsividade */
    @media (max-width: 640px) {
        .flex.space-x-2 {
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .group .tooltip {
            display: none; /* Esconder tooltips em mobile */
        }
    }
    /* Classe base para todos os botões de ação */
.action-btn {
    position: relative;
    padding: 0.6rem 0.7rem;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: all 0.2s ease-in-out;
}

/* Hover moderno */
.action-btn:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Tooltips */
.action-btn .tooltip {
    position: absolute;
    bottom: -32px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #111827;
    color: white;
    padding: 5px 8px;
    border-radius: 6px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.2s ease-in-out;
    z-index: 20;
}

.action-btn .tooltip::after {
    content: '';
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 0 6px 6px 6px;
    border-style: solid;
    border-color: transparent transparent #111827 transparent;
}

.action-btn:hover .tooltip {
    opacity: 1;
    visibility: visible;
}

/* Mobile: esconder tooltips */
@media (max-width: 640px) {
    .action-btn .tooltip {
        display: none;
    }
}

.action-btn {
    width: 40px;      /* largura fixa */
    height: 40px;     /* altura fixa */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
    position: relative;
}
.action-btn i {
    font-size: 1rem;
}

</style>