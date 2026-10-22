<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profesor', function (Blueprint $table) {
            $table->id();
            // nombre
            $table->string('nombre', 100);
            // apellidos
            $table->string('apellidos', 130);
            // especialidad
            $table->string('especialidad', 100);
            // fecha de alta
            $table->date('fecha_alta')->nullable();
            // salario
            $table->decimal('salario', 10, 2)->nullable();
            $table->timestamps();
            $table->unique(['nombre', 'apellidos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};
