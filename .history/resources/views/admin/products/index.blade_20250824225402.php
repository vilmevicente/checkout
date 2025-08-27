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
>
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
       <div class="relative bg-white rounded-lg shadow p-4">
    <!-- Imagem do Produto -->
    <img src="/storage/{{ $product-> }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-lg">

    <!-- Nome -->
    <h3 class="mt-3 text-lg font-semibold text-gray-800">{{ $product->name }}</h3>

    <!-- Descrição -->
    <p class="text-sm text-gray-600">{{ $product->description }}</p>

    <!-- Botões Editar/Apagar -->
    <div class="absolute top-2 right-2 flex gap-2">
        <a href="{{ route('admin.products.edit', $product->id) }}"
           class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
            Editar
        </a>
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
              onsubmit="return confirm('Tem certeza que deseja apagar?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                Apagar
            </button>
        </form>
    </div>
</div>

        @endforeach
    </div>
    @endif
</x-data=>
@endsection