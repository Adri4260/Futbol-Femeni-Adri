<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Classificació</h3>
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Pos
                </th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Equip
                </th>
                {{-- NOVA COLUMNA PUNTS --}}
                <th class="px-5 py-3 border-b-2 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Punts
                </th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Edat Mitjana
                </th>
                <th class="px-5 py-3 border-b-2 bg-gray-100 dark:bg-gray-700 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Ratxa (Últims 5)
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($equips as $index => $equip)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-bold text-gray-500">
                    {{ $index + 1 }}
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <div class="flex items-center">
                        @if($equip->escut)
                        <img class="w-8 h-8 rounded-full mr-2 object-cover" src="{{ asset('storage/' . $equip->escut) }}" alt="" />
                        @endif
                        <span class="font-medium text-gray-900 dark:text-gray-200">{{ $equip->nom }}</span>
                    </div>
                </td>

                {{-- DADES DE PUNTS --}}
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                    <span class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $equip->punts }}</span>
                </td>

                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                    <span class="px-2 py-1 text-xs font-semibold leading-tight text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 rounded-full">
                        {{ $equip->edat_mitjana }} anys
                    </span>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-center">
                    <div class="flex justify-center space-x-1">
                        @forelse($equip->racha as $resultat)
                        @php
                        $color = match($resultat) {
                        'G' => 'bg-green-500',
                        'P' => 'bg-red-500',
                        'E' => 'bg-blue-500',
                        default => 'bg-gray-300'
                        };
                        @endphp
                        <span class="w-6 h-6 rounded-full {{ $color }} border border-gray-200 dark:border-gray-600 shadow-sm" title="{{ $resultat }}"></span>
                        @empty
                        <span class="text-xs text-gray-400">-</span>
                        @endforelse
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>