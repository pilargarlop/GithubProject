@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{ old('nombre', $profesor->nombre) }}" id="nombre" name="nombre" required minlength="2" maxlength="100">
                    @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" value="{{ old('apellido', $profesor->apellido) }}" id="apellido" name="apellido" required minlength="3" maxlength="130">
                    @error('apellido')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="fnac" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" value="{{ old('fnac', $profesor->fnac) }}" id="fnac" name="fnac">
                    @error('fnac')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="" @selected(old('genero', $profesor->genero) === null)>Selecciona una opción</option>
                        <option value="hombre" @selected(old('genero', $profesor->genero) === 'hombre')>Masculino</option>
                        <option value="femenino" @selected(old('genero', $profesor->genero) === 'femenino')>Femenino</option>
                        <option value="otro" @selected(old('genero', $profesor->genero) === 'otro')>Otro</option>
                    </select>
                    @error('genero')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" value="{{ old('especialidad', $profesor->especialidad) }}" id="especialidad" name="especialidad" required maxlength="150">
                    @error('especialidad')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-secondary">Editar profesor</button>
            </form>
        </div>
    </div>
</div>
@endsection