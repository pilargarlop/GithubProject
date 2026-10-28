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
        <th colspan="3">Acciones</th> <!-- Para alinear las 3 columnas de botones -->
    </tr>
</thead>
                <tbody>
                    @foreach($profesor as $profeso)
                        <tr>
                            <td>{{ $profeso->id }}</td>
                            <td>{{ $profeso->nombre }}</td>
                            <td>{{ $profeso->apellido }}</td>
                            <td>{{ $profeso->especialidad }}</td>
                            <td>{{ $profeso->falta }}</td>
                            <td>{{ $profeso->salario }}</td>

                            <td> <a href="{{route('profesor.show', $profeso->id)}}"class="btn btn-secondary">View</a></td>
                             <td> <a href="{{route('profesor.edit', $profeso->id )}}"class="btn btn-secondary">Edit</a></td>
                              <!--<td> <a href="{{route('index')}}"class="btn btn-secondary">Delete</a></td>-->
                              <td><form class="confirm-dialog" data-message="{{$profeso->apellido .' , ' . $profeso->nombre}}" action="{{route('profesor.destroy', $profeso)}}"method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-secondary"></input>
                                </form>
                                </td>
                        </tr>
                    @endforeach
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
                const message = '¿Seguro que quieres borrar al alumno '+ form.dataset.message +'?' ;
                if(!confirm(message)){
                    e.preventDefault();
                }
            });
        }
    );
    </script>
@endsection