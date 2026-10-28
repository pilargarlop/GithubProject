@extends('template.base')

@section('before-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2 class="text-uppercase">Matrículas</h2>
            <p class="lead">Escolarización 2026-2027</p>
            <a class="btn btn-secondary" href="{{ route('matricula.create') }}">Crear matrícula</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @if ($errors->has('error'))
                <div class="alert alert-danger" role="alert">{{ $errors->first('error') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID alumno</th>
                        <th>Módulo</th>
                        <th>Curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matriculas as $matricula)
                        <tr>
                            <td>{{ $matricula->id }}</td>
                            <td>{{ $matricula->alumno_id }}</td>
                            <td>{{ $matricula->modulo->nombre }}</td>
                            <td>{{ $matricula->curso }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('matricula.show', $matricula) }}" class="btn btn-secondary">Ver</a>
                                <form class="confirm-dialog" data-message="del alumno #{{ $matricula->alumno_id }} en {{ $matricula->modulo->nombre }} (curso {{ $matricula->curso }})" action="{{ route('matricula.destroy', $matricula) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-secondary">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No hay matrículas registradas para esta escolarización.</td></tr>
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
                const message = '¿Seguro que quieres borrar la matrícula ' + form.dataset.message + '?';
                if(!confirm(message)){
                    e.preventDefault();
                }
            });
        }
    );
    </script>
@endsection