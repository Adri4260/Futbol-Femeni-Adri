@extends('layouts.app')

@section('content')
<h2>Nou partit</h2>

<form action="{{ route('partits.store') }}" method="POST" class="form">
    @csrf

    <label for="local_id">Equip local</label>
    <select name="local_id" id="local_id" required>
        <option value="">-- Selecciona equip local --</option>
        @foreach($equips as $equip)
        <option value="{{ $equip->id }}" @selected(old('local_id')==$equip->id)>{{ $equip->nom }}</option>
        @endforeach
    </select>

    <label for="visitant_id">Equip visitant</label>
    <select name="visitant_id" id="visitant_id" required>
        <option value="">-- Selecciona equip visitant --</option>
        @foreach($equips as $equip)
        <option value="{{ $equip->id }}" @selected(old('visitant_id')==$equip->id)>{{ $equip->nom }}</option>
        @endforeach
    </select>

    <label for="estadi_id">Estadi</label>
    <select name="estadi_id" id="estadi_id">
        <option value="">-- Selecciona estadi (opcional) --</option>
        @foreach($estadios as $estadi)
        <option value="{{ $estadi->id }}" @selected(old('estadi_id')==$estadi->id)>{{ $estadi->nom }}</option>
        @endforeach
    </select>

    <label for="data">Data</label>
    <input type="date" name="data" id="data" value="{{ old('data') }}" required>

    <label for="resultat">Resultat (opcional, format X-Y)</label>
    <input type="text" name="resultat" id="resultat" value="{{ old('resultat') }}">

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection