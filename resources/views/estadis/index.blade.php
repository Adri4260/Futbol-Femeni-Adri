@extends('layouts.app')

@section('content')
<h2>Estadis</h2>

<a href="{{ route('estadis.create') }}" class="btn btn-primary mb-3">+ Nou estadi</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Ciutat</th>
            <th>Capacitat</th>
            <th>Equip principal</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($estadis as $estadi)
        <tr>
            <td>{{ $estadi->nom }}</td>
            <td>{{ $estadi->ciutat }}</td>
            <td>{{ $estadi->capacitat }}</td>
            <td>{{ $estadi->equipPrincipal ? $estadi->equipPrincipal->nom : '-' }}</td>
            <td>
                <a href="{{ route('estadis.edit', $estadi) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('estadis.destroy', $estadi) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hi ha estadis.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $estadis->links() }}
@endsection