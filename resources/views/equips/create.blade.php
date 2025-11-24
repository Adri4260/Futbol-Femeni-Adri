@extends('layouts.app')

@section('content')
<h2>Nou equip</h2>

<form action="{{ route('equips.store') }}" method="POST" class="form">
    @csrf

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">

    <label for="ciutat">Ciutat</label>
    <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}" class="form-control">

    <label for="lliga">Lliga</label>
    <input type="text" name="lliga" id="lliga" value="{{ old('lliga') }}" class="form-control">

    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    <a href="{{ route('equips.index') }}" class="btn btn-secondary mt-3">Tornar al llistat</a>
</form>
@endsection