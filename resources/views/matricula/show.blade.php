@extends('template.base')

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card text-start">
                <div class="card-body">
                    <h2 class="card-title text-uppercase mb-4">Matrícula #{{ $matricula->id }}</h2>
                    <p><strong>ID alumno:</strong> {{ $matricula->alumno_id }}</p>
                    <p><strong>Alumno:</strong> {{ $matricula->alumno->nombre }} {{ $matricula->alumno->apellido }}</p>
                    <p><strong>Módulo:</strong> {{ $matricula->modulo->nombre }}</p>
                    <p><strong>Curso:</strong> {{ $matricula->curso }}</p>
                    <a href="{{ route('matricula.index') }}" class="btn btn-secondary">Volver al listado</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
