@extends('layouts.app')

@section('content')
    <h2>Nou partit</h2>

    <form action="{{ route('partits.store') }}" method="POST" class="form">
        @csrf

        <label for="local">Equip local</label>
        <input type="text" name="local" id="local" value="{{ old('local') }}">

        <label for="visitant">Equip visitant</label>
        <input type="text" name="visitant" id="visitant" value="{{ old('visitant') }}">

        <label for="data">Data</label>
        <input type="date" name="data" id="data" value="{{ old('data') }}">

        <label for="resultat">Resultat (opcional, format X-Y)</label>
        <input type="text" name="resultat" id="resultat" value="{{ old('resultat') }}">

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
