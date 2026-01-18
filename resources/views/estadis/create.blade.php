@extends('layouts.equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Nou Estadi</h2>

    <form action="{{ route('estadis.store') }}" method="POST">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de l'Estadi</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm" required>
        </div>

        {{-- Ciutat --}}
        <div class="mb-4">
            <label for="ciutat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ciutat</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm" required>
        </div>

        {{-- Capacitat --}}
        <div class="mb-4">
            <label for="capacitat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Capacitat</label>
            <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat') }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm" required>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('estadis.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Guardar Estadi
            </button>
        </div>
    </form>
</div>
@endsection