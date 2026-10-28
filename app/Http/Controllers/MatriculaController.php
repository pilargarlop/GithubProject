<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Modulo;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MatriculaController extends Controller
{
    public function index(): View
    {
        $matriculas = Matricula::with(['alumno', 'modulo'])
            ->orderBy('id')
            ->get();

        return view('matricula.index', compact('matriculas'));
    }

    public function create(): View
    {
        $alumnos = Alumno::orderBy('apellido')->orderBy('nombre')->get();
        $modulos = Modulo::orderBy('nombre')->get();

        return view('matricula.create', compact('alumnos', 'modulos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'alumno_id' => ['required', 'integer', 'exists:alumno,id'],
            'modulo_id' => [
                'required',
                'integer',
                'exists:modulo,id',
                Rule::unique('matricula', 'modulo_id')
                    ->where('alumno_id', $request->input('alumno_id'))
                    ->where('curso', $request->input('curso')),
            ],
            'curso' => ['required', 'string', 'max:30', 'regex:/^[\pL\pNº _\/-]+$/u'],
        ], [
            'alumno_id.required' => 'Selecciona un alumno.',
            'alumno_id.exists' => 'El alumno seleccionado no existe.',
            'modulo_id.required' => 'Selecciona un módulo.',
            'modulo_id.exists' => 'El módulo seleccionado no existe.',
            'modulo_id.unique' => 'El alumno ya está matriculado en ese módulo y curso.',
            'curso.required' => 'Indica el curso.',
            'curso.string' => 'El curso debe ser texto.',
            'curso.max' => 'El curso no puede superar los 30 caracteres.',
            'curso.regex' => 'El curso solo puede contener letras, números, espacios y los símbolos _, - y /.',
        ]);

        try {
            Matricula::create($validated);
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'modulo_id' => 'El alumno ya está matriculado en ese módulo y curso.',
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors([
                'error' => 'No se pudo guardar la matrícula.',
            ]);
        }

        return redirect()
            ->route('matricula.index')
            ->with('success', 'Matrícula creada correctamente.');
    }

    public function show(Matricula $matricula): View
    {
        $matricula->load(['alumno', 'modulo']);

        return view('matricula.show', compact('matricula'));
    }

    public function edit(Matricula $matricula)
    {
        //
    }

    public function update(Request $request, Matricula $matricula)
    {
        //
    }

    public function destroy(Matricula $matricula): RedirectResponse
    {
        try {
            $matricula->delete();
        } catch (QueryException $e) {
            return back()->withErrors([
                'error' => 'No se pudo eliminar la matrícula.',
            ]);
        }

        return redirect()
            ->route('matricula.index')
            ->with('success', 'Matrícula eliminada correctamente.');
    }
}
