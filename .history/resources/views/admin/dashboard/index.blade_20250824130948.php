@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total de Banners</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $bannersCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Banners Ativos</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $activeBannersCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total de Upsells</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $upsellsCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Upsells Ativos</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $activeUpsellsCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Banners Recentes</h3>
        <div class="space-y-4">
            @foreach($banners->take(5) as $banner)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                <div class="flex items-center">
                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="w-12 h-12 object-cover rounded">
                    <div class="ml-3">
                        <h4 class="text-sm font-medium">{{ $banner->title }}</h4>
                        <p class="text-xs text-gray-500">{{ $banner->position }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full {{ $banner->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Upsells Recentes</h3>
        <div class="space-y-4">
            @foreach($upsells->take(5) as $upsell)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                <div class="flex items-center">
                    @if($upsell->image_path)
                    <img src="{{ asset('storage/' . $upsell->image_path) }}" alt="{{ $upsell->name }}" class="w-12 h-12 object-cover rounded">
                    @endif
                    <div class="ml-3">
                        <h4 class="text-sm font-medium">{{ $upsell->name }}</h4>
                        <p class="text-xs text-gray-500">R$ {{ number_format($upsell->price, 2, ',', '.') }}</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs rounded-full {{ $upsell->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $upsell->is_active ? 'Ativo' : 'Inativo' }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection