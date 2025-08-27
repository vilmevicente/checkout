@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<div x-data="{
    deleteProduct(id, name) {
        if (confirm(`Tem certeza que deseja excluir o produto '${name}'?`)) {
            document.getElementById('delete-form-' + id).submit();
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
            <img src="/{{ $product->main_banner_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
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

                    <div class="flex space-x-3">
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="text-blue-500 hover:text-blue-700 transition text-lg"
                           title="Editar produto">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <form id="delete-form-{{ $product->id }}" 
                              action="{{ route('admin.products.destroy', $product) }}" 
                              method="POST" 
                              class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        
                        <button @click="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" 
                                class="text-red-500 hover:text-red-700 transition text-lg"
                                title="Excluir produto">
                            <i class="fas fa-trash"></i>
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

/* Garantir que os ícones sejam visíveis */
.fa-edit, .fa-trash {
    font-size: 1.1rem;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Efeito hover mais visível */
.text-blue-500:hover, .text-red-500:hover {
    transform: scale(1.2);
    transition: transform 0.2s ease-in-out;
}


/* Forçar visibilidade dos botões */
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

/* Garantir contraste */
.text-blue-500 {
    color: #3b82f6 !important;
}

.text-red-500 {
    color: #ef4444 !important;
}

/* Efeito hover mais forte */
.text-blue-500:hover {
    color: #2563eb !important;
}

.text-red-500:hover {
    color: #dc2626 !important;
}

</style>