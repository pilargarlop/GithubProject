@extends('template.base')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2 class="text-uppercase mb-4">Crear matrícula</h2>

            @if ($errors->has('error'))
                <div class="alert alert-danger" role="alert">{{ $errors->first('error') }}</div>
            @endif

            <form action="{{ route('matricula.store') }}" method="post">
                @csrf
                <div class="mb-3 text-start">
                    <label for="alumno_id" class="form-label">Alumno</label>
                    <select class="form-select" id="alumno_id" name="alumno_id" required>
                        <option value="">Selecciona un alumno</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" @selected(old('alumno_id') == $alumno->id)>
                                #{{ $alumno->id }} - {{ $alumno->nombre }} {{ $alumno->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('alumno_id')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="modulo_id" class="form-label">Módulo</label>
                    <select class="form-select" id="modulo_id" name="modulo_id" required>
                        <option value="">Selecciona un módulo</option>
                        @foreach ($modulos as $modulo)
                            <option value="{{ $modulo->id }}" @selected(old('modulo_id') == $modulo->id)>
                                {{ $modulo->nombre }} ({{ $modulo->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                    @error('modulo_id')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="curso" class="form-label">Curso</label>
                    <input type="text" class="form-control" id="curso" name="curso" value="{{ old('curso') }}" maxlength="30" placeholder="Ej.: 1º_DAW/2-A" required>
                    @error('curso')
                        <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-secondary w-100">Crear matrícula</button>
            </form>
        </div>
    </div>
</div>
@endsection