@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 mb-4">
        Editar Upsell
    </h2>

    <form method="POST" action="{{ route('upsell.update', $upsell->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
            <input id="title" type="text" name="title"
                value="{{ old('title', $upsell->title) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required autofocus>

            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
            <input id="description" type="text" name="description"
                value="{{ old('description', $upsell->description) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection
