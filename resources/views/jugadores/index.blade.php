@extends('layouts.app')

@section('content')
<h2>Jugadores</h2>

<a href="{{ route('jugadores.create') }}" class="btn btn-primary">+ Nova jugadora</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Equip</th>
            <th>Posició</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jugadores as $jugadora)
        <tr>
            <td>{{ $jugadora->nom }}</td>
            <td>{{ $jugadora->equip->nom ?? '—' }}</td>
            <td>{{ $jugadora->posicio }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No hi ha jugadores.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection