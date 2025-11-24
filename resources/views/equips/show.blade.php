@extends('layouts.app')

@section('content')
<h2>Detall de l'equip</h2>

<p><strong>Nom:</strong> {{ $equip->nom ?? '-' }}</p>
<p><strong>Ciutat:</strong> {{ $equip->ciutat ?? '-' }}</p>
<p><strong>Lliga:</strong> {{ $equip->lliga ?? '-' }}</p>

<hr>

<h4>Partits jugats</h4>
@if($partitsJugats->count() > 0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Local</th>
            <th>Visitant</th>
            <th>Data</th>
            <th>Resultat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($partitsJugats as $partit)
        <tr>
            <td>{{ $partit->local->nom }}</td>
            <td>{{ $partit->visitant->nom }}</td>
            <td>{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</td>
            <td>{{ $partit->resultat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No hi ha partits jugats.</p>
@endif

<h4>Partits pendents</h4>
@if($partitsPendents->count() > 0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Local</th>
            <th>Visitant</th>
            <th>Data</th>
            <th>Resultat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($partitsPendents as $partit)
        <tr>
            <td>{{ $partit->local->nom }}</td>
            <td>{{ $partit->visitant->nom }}</td>
            <td>{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</td>
            <td>-</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No hi ha partits pendents.</p>
@endif

<a href="{{ route('equips.index') }}" class="btn btn-secondary mt-3">Tornar al llistat</a>
@endsection