@extends('layouts.equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Nova Jugadora</h2>

    <form action="{{ route('jugadores.store') }}" method="POST">
        @csrf

        {{-- Nom --}}
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nom')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Equip --}}
        <div class="mb-4">
            <label for="equip_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Equip</label>
            <select name="equip_id" id="equip_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @if(count($equips) > 1)
                <option value="">-- Selecciona equip --</option>
                @endif

                @foreach($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
                @endforeach
            </select>
            @error('equip_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Posició --}}
        <div class="mb-4">
            <label for="posicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Posició</label>
            <select name="posicio" id="posicio" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Selecciona posició --</option>
                @foreach ($posicions as $pos)
                <option value="{{ $pos }}" {{ old('posicio') === $pos ? 'selected' : '' }}>{{ $pos }}</option>
                @endforeach
            </select>
            @error('posicio')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('jugadores.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Guardar Jugadora
            </button>
        </div>
    </form>
</div>
@endsection