@extends('template.base')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $profesor->nombre }} {{ $profesor->apellido }}</h2>
                    <dl class="row mt-4">
                        <dt class="col-sm-4">Fecha de nacimiento</dt>
                        <dd class="col-sm-8">{{ $profesor->fnac ? \Carbon\Carbon::parse($profesor->fnac)->locale('es')->translatedFormat('d/m/Y') : '—' }}</dd>
                        <dt class="col-sm-4">Género</dt>
                        <dd class="col-sm-8">{{ $profesor->genero ?? '—' }}</dd>
                        <dt class="col-sm-4">Especialidad</dt>
                        <dd class="col-sm-8">{{ $profesor->especialidad }}</dd>
                    </dl>
                    <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection