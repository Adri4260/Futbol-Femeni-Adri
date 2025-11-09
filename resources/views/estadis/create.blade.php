@extends('layouts.app')

@section('content')
    <h2>Nou estadi</h2>

    <form action="{{ route('estadis.store') }}" method="POST" class="form">
        @csrf

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}">

        <label for="ciutat">Ciutat</label>
        <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}">

        <label for="capacitat">Capacitat</label>
        <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat') }}" min="0">

        <label for="equip_principal">Equip principal</label>
        <input type="text" name="equip_principal" id="equip_principal" value="{{ old('equip_principal') }}">

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
