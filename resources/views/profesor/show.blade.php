@extends('template.base')

@section('body-class', 'profesor-show-page')

@section('css')
<link href="{{ asset('assets/style/show.css') }}" rel="stylesheet"/>
@endsection


@section('content')
<main class="profesor-show">
    <section class="profesor-show__card profesor-show__identity card">
        <img
            src="{{ asset('assets/img/avataaars.svg') }}"
            class="profesor-show__avatar"
            alt="Avatar de {{ $profesor->nombre }} {{ $profesor->apellido }}"
        >
        <div class="card-body">
            <h1 class="profesor-show__name">{{ $profesor->nombre }} {{ $profesor->apellido }}</h1>
        </div>
    </section>

    <section class="profesor-show__card profesor-show__details card">
        <div class="card-body">
            <p><strong>Especialidad:</strong> {{ $profesor->especialidad ?: 'No especificada' }}</p>
            <p><strong>Fecha de alta:</strong> {{ $profesor->created_at?->format('d/m/Y') ?? 'No disponible' }}</p>
            <p>
                <strong>Salario:</strong>
                @if ($profesor->salario !== null)
                    {{ number_format((float) $profesor->salario, 2, ',', '.') }} €
                @else
                    No especificado
                @endif
            </p>
            <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </section>
</main>
@endsection