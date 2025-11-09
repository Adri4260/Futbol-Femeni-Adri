@extends('layouts.app')

@section('content')
    <h2>Equips</h2>

    <a href="{{ route('equips.create') }}" class="btn btn-primary">+ Nou equip</a>

    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Ciutat</th>
            <th>Lliga</th>
            <th>Detall</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($equips as $index => $equip)
            <tr>
                <td>{{ $equip['nom'] ?? '-' }}</td>
                <td>{{ $equip['ciutat'] ?? '-' }}</td>
                <td>{{ $equip['lliga'] ?? '-' }}</td>
                <td><a href="{{ route('equips.show', $index) }}">Veure</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hi ha equips.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
