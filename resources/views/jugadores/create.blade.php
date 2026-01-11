@extends('layouts.equip')

@section('content')
<h2>Nova jugadora</h2>

<form action="{{ route('jugadores.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
    </div>

    <div class="mb-3">
        <label for="cognoms" class="form-label">Cognoms</label>
        <input type="text" name="cognoms" id="cognoms" class="form-control" value="{{ old('cognoms') }}">
    </div>


    <div class="mb-3">
        <label for="equip_id" class="form-label">Equip</label>
        <select name="equip_id" id="equip_id" class="form-control">
            <option value="">-- Selecciona equip --</option>
            @foreach($equips as $equip)
            <option value="{{ $equip->id }}" @selected(old('equip_id')==$equip->id)>{{ $equip->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="posicio" class="form-label">Posició</label>
        <select name="posicio" id="posicio" class="form-control">
            <option value="">-- Selecciona posició --</option>
            @foreach ($posicions as $pos)
            <option value="{{ $pos }}" @selected(old('posicio')===$pos)>{{ $pos }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection