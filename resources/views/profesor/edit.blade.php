@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{old('nombre', $profesor->nombre)}}" id="nombre" name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" value="{{old('apellido', $profesor->apellido) }}" id="apellido" name="apellido" required maxlength="130" placeholder="Introduce los apellidos del profesor">
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" value="{{old('especialidad', $profesor->especialidad) }}" id="apellido" name="apellido" required maxlength="130" placeholder="Introduce la especialidad del profesor">
                </div>
                <div class="mb-3">
                    <label for="falta" class="form-label">Falta</label>
                        <select class="form-select" id="falta" name="falta">
                            <option value="" @selected(old('falta', $profesor->falta) == '')>Selecciona una opción</option>
                            <option value="si" @selected(old('falta', $profesor->falta) == 'si')>Si</option>
                            <option value="no" @selected(old('falta', $profesor->falta) == 'no')>No</option>
                        </select>
                    
                </div>
                <div class="mb-3">
                    <label for="salario" class="form-label">Salario</label>
                    <input type="number" value="{{old('salario', $profesor->salario) }}" class="form-control" id="salario" name="salario" min="0" max="100000000" step="0.01" placeholder="Introduce su salario">
                </div>
                <button type="submit" class="btn btn-secondary">
                    Editar profesor
                </button>
            </form>
        </div>
    </div>
</div>
@endsection