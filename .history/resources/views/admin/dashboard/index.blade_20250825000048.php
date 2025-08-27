@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total de Produtos -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total de Produtos</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $productsCount }}</p>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="text-xs text-blue-600 hover:text-blue-800 flex items-center">
                Ver todos <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    <!-- Produtos Ativos -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Produtos Ativos</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $activeProductsCount }}</p>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <span class="text-xs text-green-600">
                {{ $productsCount > 0 ? round(($activeProductsCount / $productsCount) * 100, 1) : 0 }}% ativos
            </span>
        </div>
    </div>

    <!-- Total de Upsells -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total de Upsells</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $upsellsCount }}</p>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <span class="text-xs text-gray-500">
                {{ $productsCount > 0 ? round(($upsellsCount / $productsCount) * 100, 1) : 0 }}% dos produtos
            </span>
        </div>
    </div>

    <!-- Métodos de Entrega -->
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Métodos Entrega</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $deliveryMethodsCount }}</p>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-100">
            <span class="text-xs text-gray-500">
                {{ $deliveryMethodsCount }} tipos disponíveis
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Produtos Recentes -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Produtos Recentes</h3>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Ver todos</a>
        </div>
        <div class="space-y-3">
            @forelse($recentProducts->take(5) as $product)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    @if($product->main_banner_url)
                    <img src="{{ $product->main_banner_url }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded">
                    @else
                    <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>
                    @endif
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 truncate max-w-xs">{{ $product->name }}</h4>
                        <p class="text-xs text-gray-500">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-1 text-xs rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                    </span>
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-16"/>
                </svg>
                <p class="mt-2">Nenhum produto cadastrado</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Upsells Recentes -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900">Upsells Recentes</h3>
            <span class="text-sm text-gray-500">{{ $upsellsCount }} total</span>
        </div>
        <div class="space-y-3">
            @forelse($recentUpsells->take(5) as $upsell)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-3">
                    @if($upsell->main_banner_url)
                    <img src="{{ $upsell->main_banner_url }}" alt="{{ $upsell->name }}" class="w-10 h-10 object-cover rounded">
                    @else
                    <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    @endif
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 truncate max-w-xs">{{ $upsell->name }}</h4>
                        <p class="text-xs text-gray-500">R$ {{ number_format($upsell->price, 2, ',', '.') }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full {{ $upsell->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $upsell->is_active ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <p class="mt-2">Nenhum upsell cadastrado</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Ações Rápidas -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Ações Rápidas</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.products.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
            <div class="p-2 bg-blue-100 rounded-full text-blue-600 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Novo Produto</h4>
                <p class="text-sm text-gray-500">Criar um novo produto</p>
            </div>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
            <div class="p-2 bg-green-100 rounded-full text-green-600 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Gerenciar Produtos</h4>
                <p class="text-sm text-gray-500">Ver todos os produtos</p>
            </div>
        </a>
        
        <a href="{{ route('admin.products.index') }}?filter=active" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
            <div class="p-2 bg-purple-100 rounded-full text-purple-600 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">Produtos Ativos</h4>
                <p class="text-sm text-gray-500">Ver produtos ativos</p>
            </div>
        </a>
    </div>
</div>

<!-- Estatísticas Adicionais -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Distribuição de Preços</h3>
        <div class="space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Produto mais caro</span>
                <span class="font-medium">R$ {{ number_format($maxPrice, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Produto mais barato</span>
                <span class="font-medium">R$ {{ number_format($minPrice, 2, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Preço médio</span>
                <span class="font-medium">R$ {{ number_format($avgPrice, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Status do Sistema</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Produtos com upsells</span>
                <span class="font-medium">{{ $productsWithUpsellsCount }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Produtos com anexos</span>
                <span class="font-medium">{{ $productsWithAttachmentsCount }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Última atualização</span>
                <span class="font-medium text-sm">{{ $lastUpdated }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.max-w-xs {
    max-width: 16rem;
}
</style>