@extends('layouts.app')

@section('title', 'Gerenciar Banners')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900">Banners do Checkout</h3>
            <a href="{{ route('admin.banners.create') }}" 
               class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                Novo Banner
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($banners as $banner)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                {{ $banner->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                    </span>
                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                        Posição: {{ $banner->position }}
                    </span>
                </div>

                <img src="{{ asset('storage/' . $banner->image_path) }}" 
                     alt="{{ $banner->title }}" 
                     class="w-full h-32 object-cover rounded-md mb-4">

                <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $banner->title }}</h4>
                
                @if($banner->link)
                <p class="text-sm text-gray-600 mb-4">
                    Link: <a href="{{ $banner->link }}" target="_blank" class="text-indigo-600 hover:underline">{{ $banner->link }}</a>
                </p>
                @endif

                <div class="flex space-x-2">
                    <a href="{{ route('admin.banners.edit', $banner) }}" 
                       class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                        Editar
                    </a>
                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" 
                          onsubmit="return confirm('Tem certeza que deseja excluir este banner?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($banners->isEmpty())
            <div class="col-span-2 text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum banner encontrado</h3>
                <p class="mt-1 text-sm text-gray-500">Comece criando um novo banner para o checkout.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection