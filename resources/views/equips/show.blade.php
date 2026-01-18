@extends('layouts.equip')

@section('content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
    {{-- Capçalera amb Escut i Nom --}}
    <div class="flex flex-col items-center p-8 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
        @if($equip->escut)
        <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut de {{ $equip->nom }}" class="w-32 h-32 rounded-full shadow-md object-cover mb-4">
        @else
        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center mb-4 text-gray-500">
            <span class="text-sm">Sense Escut</span>
        </div>
        @endif
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $equip->nom }}</h1>
        <p class="text-gray-600 dark:text-gray-300 text-lg">{{ $equip->ciutat }} - {{ $equip->lliga }}</p>
    </div>

    {{-- Detalls --}}
    <div class="p-6">
        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Informació</h3>
        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
            <li><strong>Estadi:</strong> {{ $equip->estadi ? $equip->estadi->nom : 'No assignat' }}</li>
            <li><strong>Jugadores registrades:</strong> {{ $equip->jugadores->count() }}</li>
        </ul>

        <h3 class="text-xl font-semibold mt-6 mb-4 text-gray-800 dark:text-gray-200">Plantilla</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @forelse($equip->jugadores as $jugadora)
            <div class="bg-gray-100 dark:bg-gray-900 p-3 rounded flex justify-between items-center">
                <span class="font-medium">{{ $jugadora->nom }}</span>
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $jugadora->posicio }}</span>
            </div>
            @empty
            <p class="text-gray-500 italic">No hi ha jugadores registrades.</p>
            @endforelse
        </div>
    </div>

    {{-- Botons d'Acció --}}
    <div class="p-6 bg-gray-50 dark:bg-gray-700 flex justify-between items-center">
        {{-- Botó per a tornar al llistat --}}
        <a href="{{ route('equips.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center">
            &larr; Tornar al llistat
        </a>

        {{-- Botó per a Editar (només si tens permís) --}}
        @can('update', $equip)
        <a href="{{ route('equips.edit', $equip) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow">
            Editar Equip
        </a>
        @endcan
    </div>
</div>
@endsection