@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3 text-start">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{old('nombre', $profesor->nombre)}}" id="nombre" name="nombre" required maxlength="100" placeholder="Introduce el nombre del profesor">
                </div>
                <div class="mb-3 text-start">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" value="{{old('apellido', $profesor->apellido) }}" id="apellido" name="apellido" required maxlength="130" placeholder="Introduce los apellidos del profesor">
                </div>
                <div class="mb-3 text-start">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" value="{{ old('especialidad', $profesor->especialidad) }}" id="especialidad" name="especialidad" maxlength="130" placeholder="Introduce la especialidad">
                    @error('especialidad')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="falta" class="form-label">Falta</label>
                    <select class="form-select" id="falta" name="falta">
                        <option value="" @selected(old('falta', $profesor->falta) === '')>Selecciona una opción</option>
                        <option value="si" @selected(old('falta', $profesor->falta) === 'si')>Sí</option>
                        <option value="no" @selected(old('falta', $profesor->falta) === 'no')>No</option>
                    </select>
                    @error('falta')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label for="salario" class="form-label">Salario</label>
                    <input type="number" value="{{ old('salario', $profesor->salario) }}" class="form-control" id="salario" name="salario" min="0" max="100000000" step="0.01" placeholder="Introduce el salario">
                    @error('salario')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary">
                    Editar profesor
                </button>
            </form>
        </div>
    </div>
</div>
@endsection