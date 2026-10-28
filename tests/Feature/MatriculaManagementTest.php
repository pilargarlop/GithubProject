<?php

namespace Tests\Feature;

use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Modulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatriculaManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_matriculas_for_the_requested_school_year(): void
    {
        $alumno = $this->createAlumno();
        $modulo = $this->createModulo();
        Matricula::create([
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
            'curso' => '1º_DAW/2-A',
        ]);

        $this->get(route('matricula.index'))
            ->assertOk()
            ->assertSee('Escolarización 2026-2027')
            ->assertSee('ID alumno')
            ->assertSee((string) $alumno->id)
            ->assertSee($modulo->nombre)
            ->assertSee('1º_DAW/2-A')
            ->assertSee('Curso')
            ->assertSee('Acciones');
    }

    public function test_it_creates_and_deletes_matriculas_with_success_messages(): void
    {
        $alumno = $this->createAlumno();
        $modulo = $this->createModulo();

        $this->get(route('matricula.create'))
            ->assertOk()
            ->assertSee($alumno->nombre)
            ->assertSee($modulo->nombre);

        $this->post(route('matricula.store'), [
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
            'curso' => '1_DAW/2-A',
        ])
            ->assertRedirect(route('matricula.index'))
            ->assertSessionHas('success', 'Matrícula creada correctamente.');

        $matricula = Matricula::firstOrFail();

        $this->get(route('matricula.index'))
            ->assertOk()
            ->assertSee('Matrícula creada correctamente.');

        $this->get(route('matricula.show', $matricula))
            ->assertOk()
            ->assertSee('Matrícula #')
            ->assertSee($alumno->nombre)
            ->assertSee($modulo->nombre)
            ->assertSee('1_DAW/2-A')
            ->assertSee('Volver al listado');

        $this->delete(route('matricula.destroy', $matricula))
            ->assertRedirect(route('matricula.index'))
            ->assertSessionHas('success', 'Matrícula eliminada correctamente.');

        $this->get(route('matricula.index'))
            ->assertOk()
            ->assertSee('Matrícula eliminada correctamente.');

        $this->assertDatabaseMissing('matricula', ['id' => $matricula->id]);
    }

    public function test_it_rejects_duplicate_matriculas_for_the_same_course(): void
    {
        $alumno = $this->createAlumno();
        $modulo = $this->createModulo();
        Matricula::create([
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
            'curso' => '1_DAW/2-A',
        ]);

        $this->from(route('matricula.create'))
            ->post(route('matricula.store'), [
                'alumno_id' => $alumno->id,
                'modulo_id' => $modulo->id,
                'curso' => '1_DAW/2-A',
            ])
            ->assertRedirect(route('matricula.create'))
            ->assertSessionHasErrors('modulo_id');

        $this->assertDatabaseCount('matricula', 1);
    }

    public function test_it_rejects_unsupported_course_symbols(): void
    {
        $alumno = $this->createAlumno();
        $modulo = $this->createModulo();

        $this->from(route('matricula.create'))
            ->post(route('matricula.store'), [
                'alumno_id' => $alumno->id,
                'modulo_id' => $modulo->id,
                'curso' => '1º@DAW',
            ])
            ->assertRedirect(route('matricula.create'))
            ->assertSessionHasErrors('curso');

        $this->assertDatabaseCount('matricula', 0);
    }

    private function createAlumno(): Alumno
    {
        return Alumno::create([
            'nombre' => 'Ana',
            'apellido' => 'García',
        ]);
    }

    private function createModulo(): Modulo
    {
        return Modulo::create([
            'nombre' => 'Matemáticas',
            'abreviatura' => 'MAT',
        ]);
    }
}
