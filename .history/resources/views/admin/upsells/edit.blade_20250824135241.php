@extends('layouts.admin')

@section('title', 'Editar Upsell')

@section('content')
<div class="bg-white shadow rounded-lg max-w-2xl mx-auto">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-6">Editar Upsell</h3>

        <form action="{{ route('admin.upsells.update', $upsell) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nome do Upsell</label>
                    <input type="text" name="name" id="name" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('name', $upsell->name) }}">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $upsell->description) }}</textarea>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Preço</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('price', $upsell->price) }}">
                </div>

                <div>
                    <label for="original_price" class="block text-sm font-medium text-gray-700">Preço Original (opcional)</label>
                    <input type="number" name="original_price" id="original_price" step="0.01" min="0"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('original_price', $upsell->original_price) }}">
                </div>

                @if($upsell->image_path)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Imagem Atual</label>
                    <img src="{{ asset('storage/' . $upsell->image_path) }}" 
                         alt="{{ $upsell->name }}" 
                         class="mt-2 w-32 h-32 object-cover rounded-md">
                </div>
                @endif

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Nova Imagem (opcional)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Ordem de Exibição</label>
                    <input type="number" name="order" id="order" min="0" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('order', $upsell->order) }}">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                           {{ old('is_active', $upsell->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Upsell ativo</label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.upsells.index') }}" 
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Cancelar
                </a>
                <button type="submit" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Atualizar Upsell
                </button>
            </div>
        </form>
    </div>
</div>
@endsection