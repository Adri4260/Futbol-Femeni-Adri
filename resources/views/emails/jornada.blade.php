<x-mail::message>
    # Resum de la Jornada

    Aquests són els partits previstos:

    <x-mail::table>
        | Data | Local | Visitant |
        |:-----|:------|:---------|
        @foreach($partits as $partit)
        | {{ $partit->data }} | {{ $partit->local->nom }} | {{ $partit->visitant->nom }} |
        @endforeach
    </x-mail::table>

    Gràcies,<br>
    {{ config('app.name') }}
</x-mail::message>