@extends('layouts.app')

@section('title', 'Gerenciar Upsells')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900">Upsells do Checkout</h3>
            <a href="{{ route('admin.upsells.create') }}" 
               class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                Novo Upsell
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upsells as $upsell)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-4">
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                {{ $upsell->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $upsell->is_active ? 'Ativo' : 'Inativo' }}
                    </span>
                    <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                        Ordem: {{ $upsell->order }}
                    </span>
                </div>

                @if($upsell->image_path)
                <img src="{{ asset('storage/' . $upsell->image_path) }}" 
                     alt="{{ $upsell->name }}" 
                     class="w-full h-32 object-cover rounded-md mb-4">
                @endif

                <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $upsell->name }}</h4>
                <p class="text-sm text-gray-600 mb-4">{{ Str::limit($upsell->description, 100) }}</p>

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <span class="text-2xl font-bold text-gray-900">
                            R$ {{ number_format($upsell->price, 2, ',', '.') }}
                        </span>
                        @if($upsell->original_price)
                        <span class="text-sm text-gray-500 line-through ml-2">
                            R$ {{ number_format($upsell->original_price, 2, ',', '.') }}
                        </span>
                        @endif
                    </div>
                    @if($upsell->discount_percentage)
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">
                        -{{ $upsell->discount_percentage }}%
                    </span>
                    @endif
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.upsells.edit', $upsell) }}" 
                       class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                        Editar
                    </a>
                    <form action="{{ route('admin.upsells.destroy', $upsell) }}" method="POST" 
                          onsubmit="return confirm('Tem certeza que deseja excluir este upsell?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($upsells->isEmpty())
            <div class="col-span-3 text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum upsell encontrado</h3>
                <p class="mt-1 text-sm text-gray-500">Comece criando um novo upsell para aumentar suas vendas.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection