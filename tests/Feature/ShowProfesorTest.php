<?php

namespace Tests\Feature;

use App\Models\Profesor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProfesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_the_profesor_details_in_spanish_format(): void
    {
        $profesor = Profesor::create([
            'nombre' => 'Antonio',
            'apellido' => 'Lobato',
            'especialidad' => 'Ingenieria',
            'salario' => '2980.00',
        ]);
        $profesor->created_at = '2026-10-22 12:00:00';
        $profesor->save();

        $this->get(route('profesor.show', $profesor))
            ->assertOk()
            ->assertSee('Antonio Lobato')
            ->assertSee('Especialidad:')
            ->assertSee('Ingenieria')
            ->assertSee('Fecha de alta:')
            ->assertSee('22/10/2026')
            ->assertSee('Salario:')
            ->assertSee('2.980,00 €')
            ->assertSee('Volver al listado')
            ->assertSee('assets/img/avataaars.svg');
    }
}
