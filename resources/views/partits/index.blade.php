@extends('layouts.app')

@section('content')
<h2>Partits</h2>

<a href="{{ route('partits.create') }}" class="btn btn-primary mb-3">+ Nou partit</a>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Local</th>
            <th>Visitant</th>
            <th>Estadi</th>
            <th>Data</th>
            <th>Resultat</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($partits as $partit)
        <tr>
            <td>
                <x-equip-mini :nom="$partit->local->nom ?? '-'" />
            </td>
            <td>
                <x-equip-mini :nom="$partit->visitant->nom ?? '-'" />
            </td>
            <td>{{ $partit->estadi->nom ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</td>
            <td>{{ $partit->resultat ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hi ha partits.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection