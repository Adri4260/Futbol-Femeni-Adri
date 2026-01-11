<div class="p-6 bg-white rounded-lg shadow-md">
    <div class="flex flex-wrap gap-4 mb-6 items-end">
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Buscar Equip:</label>
            <input wire:model="equip" type="text" placeholder="Ex: Barcelona"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2">Data:</label>
            <input wire:model="data" type="date"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div>
            <button wire:click="filtrar"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                Filtrar Resultats
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Data</th>
                    <th class="px-4 py-2 text-left">Local</th>
                    <th class="px-4 py-2 text-left">Visitant</th>
                    <th class="px-4 py-2 text-center">Resultat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partits as $partit)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $partit->data }}</td>
                    {{-- CAMBIOS AQUÍ: local y visitant --}}
                    <td class="px-4 py-2 font-semibold">{{ $partit->local->nom }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $partit->visitant->nom }}</td>
                    <td class="px-4 py-2 text-center">
                        @if($partit->resultat)
                        <span class="bg-gray-200 px-2 py-1 rounded">
                            {{ $partit->resultat }}
                        </span>
                        @else
                        <span class="text-gray-400 text-sm">Pendent</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                        No s'han trobat partits amb aquests criteris.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>