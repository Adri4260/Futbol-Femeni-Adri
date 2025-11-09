@extends('layouts.app')

@section('content')
    <h2>Jugadores</h2>

    <a href="{{ route('jugadores.create') }}" class="btn btn-primary">+ Nova jugadora</a>

    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Equip</th>
            <th>Posició</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($jugadores as $jugadora)
            <x-jugadora :jugadora="$jugadora" />
        @empty
            <tr>
                <td colspan="3">No hi ha jugadores.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
