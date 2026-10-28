@extends('template.base')

@section('before-content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
<a class="btn btn-secondary" href="{{ route('profesor.create') }}">Crear Profesor</a>
</div>
</div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <table class="table table-hover">
                <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Especialidad</th>
        <th>Falta</th>
        <th>Salario</th>
        <th>Fecha de alta</th>
        <th colspan="3">Acciones</th> <!-- Para alinear las 3 columnas de botones -->
    </tr>
</thead>
                <tbody>
                    @forelse($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->id }}</td>
                            <td>{{ $profesor->nombre }}</td>
                            <td>{{ $profesor->apellido }}</td>
                            <td>{{ $profesor->especialidad ?? '—' }}</td>
                            <td>{{ $profesor->falta ?? '—' }}</td>
                            <td>{{ $profesor->salario !== null ? number_format((float) $profesor->salario, 2, ',', '.') . ' €' : '—' }}</td>
                            <td>{{ $profesor->created_at?->format('d/m/Y') ?? '—' }}</td>

                            <td> <a href="{{ route('profesor.show', $profesor) }}" class="btn btn-secondary">Ver</a></td>
                            <td> <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a></td>
                            <td><form class="confirm-dialog" data-message="{{ $profesor->apellido . ', ' . $profesor->nombre }}" action="{{ route('profesor.destroy', $profesor) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Eliminar" class="btn btn-secondary">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10">No hay profesores registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('form.confirm-dialog').forEach(
        form => {
            form.addEventListener('submit', e => {
                const message = '¿Seguro que quieres borrar al profesor ' + form.dataset.message + '?';
                if(!confirm(message)){
                    e.preventDefault();
                }
            });
        }
    );
    </script>
@endsection