@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-8">
    <h2 class="text-2xl font-bold mb-6">Editar Perfil</h2>

    <!-- Mensagens de sucesso -->
    @if (session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    <!-- Formulário de atualização -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Nome -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-sm text-gray-700">Nome</label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" 
                   value="{{ old('name', $user->name) }}" 
                   required autofocus>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" 
                   value="{{ old('email', $user->email) }}" 
                   required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-end gap-3">
            <button type="reset" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection
