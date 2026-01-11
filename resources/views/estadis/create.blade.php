@extends('layouts.equip')

@section('content')
<h2>Nou estadi</h2>

<form action="{{ route('estadis.store') }}" method="POST" class="form">
    @csrf

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">

    <label for="ciutat">Ciutat</label>
    <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}" class="form-control">

    <label for="capacitat">Capacitat</label>
    <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat') }}" min="0" class="form-control">

    <label for="equip_principal_id">Equip principal</label>
    <select name="equip_principal_id" id="equip_principal_id" class="form-select">
        <option value="">-- Sense equip principal --</option>
        @foreach($equips as $equip)
        <option value="{{ $equip->id }}" {{ old('equip_principal_id') == $equip->id ? 'selected' : '' }}>
            {{ $equip->nom }}
        </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
</form>
@endsection