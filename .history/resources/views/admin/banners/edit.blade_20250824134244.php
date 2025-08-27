@extends('layouts.admin')

@section('title', 'Editar Banner')

@section('content')
<div class="bg-white shadow rounded-lg max-w-2xl mx-auto">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-6">Editar Banner</h3>

        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título do Banner</label>
                    <input type="text" name="title" id="title" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('title', $banner->title) }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Imagem Atual</label>
                    <img src="{{ asset('storage/' . $banner->image_path) }}" 
                         alt="{{ $banner->title }}" 
                         class="mt-2 w-32 h-32 object-cover rounded-md">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Nova Imagem (opcional)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>

                <div>
                    <label for="link" class="block text-sm font-medium text-gray-700">Link (opcional)</label>
                    <input type="url" name="link" id="link"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           value="{{ old('link', $banner->link) }}" placeholder="https://...">
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700">Posição</label>
                    <select name="position" id="position" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="top" {{ old('position', $banner->position) == 'top' ? 'selected' : '' }}>Topo</option>
                        <option value="middle" {{ old('position', $banner->position) == 'middle' ? 'selected' : '' }}>Meio</option>
                        <option value="bottom" {{ old('position', $banner->position) == 'bottom' ? 'selected' : '' }}>Rodapé</option>
                    </select>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                           {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Banner ativo</label>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.banners.index') }}" 
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Cancelar
                </a>
                <button type="submit" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Atualizar Banner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection