@extends('layouts.equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Nou Partit</h2>

    <form action="{{ route('partits.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            {{-- Local --}}
            <div>
                <label for="local_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Equip Local</label>
                <select name="local_id" id="local_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm">
                    @foreach(\App\Models\Equip::all() as $equip)
                    <option value="{{ $equip->id }}" {{ old('local_id') == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Visitant --}}
            <div>
                <label for="visitant_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Equip Visitant</label>
                <select name="visitant_id" id="visitant_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm">
                    @foreach(\App\Models\Equip::all() as $equip)
                    <option value="{{ $equip->id }}" {{ old('visitant_id') == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Estadi --}}
        <div class="mb-4">
            <label for="estadi_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estadi</label>
            <select name="estadi_id" id="estadi_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm">
                <option value="">-- Selecciona estadi --</option>
                @foreach(\App\Models\Estadi::all() as $estadi)
                <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>{{ $estadi->nom }}</option>
                @endforeach
            </select>
        </div>

        {{-- Data --}}
        <div class="mb-4">
            <label for="data" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data del Partit</label>
            <input type="datetime-local" name="data" id="data" value="{{ old('data') }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm">
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('partits.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Crear Partit
            </button>
        </div>
    </form>
</div>
@endsection