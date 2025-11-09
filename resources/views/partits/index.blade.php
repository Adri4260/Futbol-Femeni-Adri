@extends('layouts.app')

@section('content')
    <h2>Partits</h2>

    <a href="{{ route('partits.create') }}" class="btn btn-primary">+ Nou partit</a>

    <table class="table">
        <thead>
        <tr>
            <th>Local</th>
            <th>Visitant</th>
            <th>Data</th>
            <th>Resultat</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($partits as $partit)
            <tr>
                <td><x-equip-mini :nom="$partit['local'] ?? '-'" /></td>
                <td><x-equip-mini :nom="$partit['visitant'] ?? '-'" /></td>
                <td>{{ $partit['data'] ?? '-' }}</td>
                <td>{{ $partit['resultat'] ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hi ha partits.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
