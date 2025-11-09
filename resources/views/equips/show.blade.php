@extends('layouts.app')

@section('content')
    <h2>Detall de l'equip</h2>

    <p><strong>Nom:</strong> {{ $equip['nom'] ?? '-' }}</p>
    <p><strong>Ciutat:</strong> {{ $equip['ciutat'] ?? '-' }}</p>
    <p><strong>Lliga:</strong> {{ $equip['lliga'] ?? '-' }}</p>

    <a href="{{ route('equips.index') }}" class="btn">Tornar al llistat</a>
@endsection
