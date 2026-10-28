<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfesorController extends Controller
{
    private const RULES = [
        'nombre' => 'required|string|max:100|min:2',
        'apellido' => 'required|string|max:130|min:2',
        'especialidad' => 'nullable|string|max:130|min:2',
        'falta' => 'nullable|in:si,no',
        'salario' => 'nullable|numeric|gte:0|lte:100000000|decimal:0,2',
    ];

    public function create(): View
    {
        return view('profesor.create');
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {   
        try {
            $profesor->delete();
        } catch(\Exception $e) {
            return back()->withErrors([
                'error' => 'No se ha podido borrar el profesor.',
            ]);
        }
        return redirect()->route('profesor.index')->with(['success' => 'Se ha borrado al profesor.']);
    }

    public function edit(Profesor $profesor): View
    {
        return view('profesor.edit', ['profesor' => $profesor]);
    }

    private static function getMessages(): array 
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.min' => 'El apellido debe tener al menos 2 caracteres.',
            'especialidad.min' => 'La especialidad debe tener al menos 2 caracteres.',
            'falta.in' => 'Selecciona un valor válido para la falta.',
            'salario.numeric' => 'El salario debe ser un número.',
            'salario.lte' => 'El salario supera el límite permitido.',
            'salario.decimal' => 'El salario debe tener como máximo 2 decimales.',
        ];
    }

    public function index(): View
    {
        return view('profesor.index', ['profesor' => Profesor::all()]);
    }

    public function show(Profesor $profesor): View
    {
        return view('profesor.show', ['profesor' => $profesor]);
    }

    public function store(Request $request): RedirectResponse
    {
        $messages = self::getMessages();
        $validator = Validator::make($request->all(), self::RULES, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            Profesor::create($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Nombre y apellidos ya existentes.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'No se ha podido crear el profesor.',
            ]);
        }
        
        return redirect()->route('profesor.index')->with(['success' => 'Se ha creado el profesor correctamente.']);
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $validator = Validator::make($request->all(), self::RULES, self::getMessages());

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        try {
            $profesor->update($request->all());
        } catch (UniqueConstraintViolationException $e) {
            return back()->withInput()->withErrors([
                'error' => 'Nombre y apellidos ya existentes.',
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Error al editar el profesor.',
            ]);
        }

        return redirect()->route('profesor.index')->with(['success' => 'Profesor actualizado correctamente.']);
    }
}