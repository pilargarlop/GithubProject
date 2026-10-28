<?php

namespace Tests\Feature;

use App\Models\Profesor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfesorSuccessMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_success_messages_when_creating_and_deleting_a_profesor(): void
    {
        $this->post(route('profesor.store'), [
            'nombre' => 'Ana',
            'apellido' => 'García',
            'especialidad' => 'Matemáticas',
            'salario' => '2980.00',
        ])->assertRedirect(route('profesor.index'));

        $profesor = Profesor::where('nombre', 'Ana')->firstOrFail();

        $this->get(route('profesor.index'))
            ->assertOk()
            ->assertSee('Profesor creado correctamente.');

        $this->delete(route('profesor.destroy', $profesor))
            ->assertRedirect(route('profesor.index'));

        $this->get(route('profesor.index'))
            ->assertOk()
            ->assertSee('Profesor eliminado correctamente.');

        $this->assertDatabaseMissing('profesor', ['id' => $profesor->id]);
    }
}
