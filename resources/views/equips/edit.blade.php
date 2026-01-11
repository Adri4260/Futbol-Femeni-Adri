@extends('layouts.equip')

@section('title', 'Editar Equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Equip: {{ $equip->nom }}</h2>

    <form action="{{ route('equips.update', $equip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Important for updates --}}

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $equip->nom) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nom')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ciutat --}}
        <div class="mb-4">
            <label for="ciutat" class="block text-sm font-medium text-gray-700 mb-1">Ciutat:</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $equip->ciutat) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('ciutat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lliga --}}
        <div class="mb-4">
            <label for="lliga" class="block text-sm font-medium text-gray-700 mb-1">Lliga:</label>
            <input type="text" name="lliga" id="lliga" value="{{ old('lliga', $equip->lliga) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('lliga')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Escut (Image) --}}
        <div class="mb-6">
            <label for="escut" class="block text-sm font-medium text-gray-700 mb-1">Escut (Opcional):</label>

            @if($equip->escut)
            <div class="mb-2">
                <p class="text-xs text-gray-500 mb-1">Escut actual:</p>
                <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut actual" class="h-16 w-16 object-contain border rounded p-1">
            </div>
            @endif

            <input type="file" name="escut" id="escut"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('escut')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('equips.index') }}" class="text-gray-600 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Actualitzar Equip
            </button>
        </div>
    </form>
</div>
@endsection