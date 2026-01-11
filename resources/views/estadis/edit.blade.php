@extends('layouts.equip')

@section('title', __('Editar Estadi'))

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Editar Estadi') }}: {{ $estadi->nom }}</h2>

    <form action="{{ route('estadis.update', $estadi) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Nom') }}:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $estadi->nom) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nom')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ciutat --}}
        <div class="mb-4">
            <label for="ciutat" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Ciutat') }}:</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('ciutat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Capacitat --}}
        <div class="mb-4">
            <label for="capacitat" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Capacitat') }}:</label>
            <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('capacitat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('estadis.index') }}" class="text-gray-600 hover:text-gray-900">{{ __('Cancel·lar') }}</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                {{ __('Actualitzar Estadi') }}
            </button>
        </div>
    </form>
</div>
@endsection