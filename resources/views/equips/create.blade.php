@extends('layouts.app')

@section('content')
    <h2>Nou equip</h2>

    <form action="{{ route('equips.store') }}" method="POST" class="form">
        @csrf

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom') }}">

        <label for="ciutat">Ciutat</label>
        <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}">

        <label for="lliga">Lliga</label>
        <input type="text" name="lliga" id="lliga" value="{{ old('lliga') }}">

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
