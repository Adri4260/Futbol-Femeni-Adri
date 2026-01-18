@extends('layouts.equip')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Editar Partit</h2>

    <form action="{{ route('partits.update', $partit) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Comprovar si és àrbitre per a bloquejar camps --}}
        @php
        $isArbitre = auth()->user()->role === 'arbitre';
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            {{-- Local --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Local</label>
                <select name="local_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm" {{ $isArbitre ? 'disabled' : '' }}>
                    @foreach(\App\Models\Equip::all() as $equip)
                    <option value="{{ $equip->id }}" {{ $partit->local_id == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                    @endforeach
                </select>
                {{-- Si està disabled, hem d'enviar el valor ocult perquè no es perda --}}
                @if($isArbitre) <input type="hidden" name="local_id" value="{{ $partit->local_id }}"> @endif
            </div>

            {{-- Visitant --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Visitant</label>
                <select name="visitant_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm" {{ $isArbitre ? 'disabled' : '' }}>
                    @foreach(\App\Models\Equip::all() as $equip)
                    <option value="{{ $equip->id }}" {{ $partit->visitant_id == $equip->id ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                    @endforeach
                </select>
                @if($isArbitre) <input type="hidden" name="visitant_id" value="{{ $partit->visitant_id }}"> @endif
            </div>
        </div>

        {{-- Estadi --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estadi</label>
            <select name="estadi_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm" {{ $isArbitre ? 'disabled' : '' }}>
                @foreach(\App\Models\Estadi::all() as $estadi)
                <option value="{{ $estadi->id }}" {{ $partit->estadi_id == $estadi->id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
                @endforeach
            </select>
            @if($isArbitre) <input type="hidden" name="estadi_id" value="{{ $partit->estadi_id }}"> @endif
        </div>

        {{-- Data --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data i Hora</label>
            <input type="datetime-local" name="data" value="{{ \Carbon\Carbon::parse($partit->data)->format('Y-m-d\TH:i') }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg shadow-sm" {{ $isArbitre ? 'readonly' : '' }}>
        </div>

        {{-- RESULTAT (L'únic que interessa a l'àrbitre) --}}
        <div class="mb-6 bg-gray-50 dark:bg-gray-900 p-4 rounded border dark:border-gray-700">
            <label class="block text-sm font-bold text-gray-800 dark:text-gray-200 mb-2">Resultat (Gols Local - Gols Visitant)</label>
            <input type="text" name="resultat" value="{{ old('resultat', $partit->resultat) }}"
                placeholder="Ex: 2-1"
                class="w-full border-blue-300 dark:border-blue-500 dark:bg-gray-800 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg font-bold text-center">
            @error('resultat')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Format: GolsLocal-GolsVisitant (ex: 2-1, 0-0)</p>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('partits.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900">Cancel·lar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                Actualitzar Partit
            </button>
        </div>
    </form>
</div>
@endsection