<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreAlumnoTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_alumno_using_the_database_column_names(): void
    {
        $response = $this->post(route('alumno.store'), [
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => '4.00',
        ]);

        $response->assertRedirect(route('alumno.index'));
        $this->assertDatabaseHas('alumno', [
            'nombre' => 'Antonio',
            'apellido' => 'Alba',
            'fnac' => '2000-01-01',
            'genero' => 'hombre',
            'notaacceso' => 4,
        ]);

        $this->get(route('alumno.index'))
            ->assertOk()
            ->assertSee('Alba');
    }
}
