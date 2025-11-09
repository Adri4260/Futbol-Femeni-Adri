@extends('layouts.app')

@section('content')
    <h2>Nova jugadora</h2>

    <form action="{{ route('jugadores.store') }}" method="POST" class="form">
        @csrf

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}">

        <label for="equip">Equip</label>
        <input type="text" name="equip" id="equip" value="{{ old('equip') }}">

        <label for="posicio">Posició</label>
        <select name="posicio" id="posicio">
            <option value="">-- Selecciona posició --</option>
            @foreach ($posicions as $pos)
                <option value="{{ $pos }}" @selected(old('posicio') === $pos)>{{ $pos }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
