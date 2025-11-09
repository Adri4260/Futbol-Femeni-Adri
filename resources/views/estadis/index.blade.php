@extends('layouts.app')

@section('content')
    <h2>Estadis</h2>

    <a href="{{ route('estadis.create') }}" class="btn btn-primary">+ Nou estadi</a>

    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Ciutat</th>
            <th>Capacitat</th>
            <th>Equip principal</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($estadis as $estadi)
            <x-estadi :estadi="$estadi" />
        @empty
            <tr>
                <td colspan="4">No hi ha estadis.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
