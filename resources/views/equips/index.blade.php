@extends('layouts.app')

@section('content')
<h2>Equips</h2>

<a href="{{ route('equips.create') }}" class="btn btn-primary mb-3">+ Nou equip</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Ciutat</th>
            <th>Lliga</th>
            <th>Detall</th>
        </tr>
    </thead>
    <tbody>
        @forelse($equips as $equip)
        <tr>
            <td>{{ $equip->nom }}</td>
            <td>{{ $equip->ciutat }}</td>
            <td>{{ $equip->lliga }}</td>
            <td>
                <a href="{{ route('equips.show', $equip) }}" class="btn btn-sm btn-info">Veure</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No hi ha equips.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection