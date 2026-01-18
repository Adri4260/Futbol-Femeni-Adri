@extends('layouts.equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Nou Equip</h2>

    <form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de l'Equip</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Ciutat --}}
        <div class="mb-4">
            <label for="ciutat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ciutat</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('ciutat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Lliga --}}
        <div class="mb-4">
            <label for="lliga" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Lliga</label>
            <input type="text" name="lliga" id="lliga" value="{{ old('lliga') }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('lliga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Escut (Imatge) --}}
        <div class="mb-4">
            <label for="escut" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Escut (Opcional)</label>
            <input type="file" name="escut" id="escut" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            @error('escut') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('equips.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Guardar Equip
            </button>
        </div>
    </form>
</div>
@endsection