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
            // apellido
            $table->string('apellido', 130);
            // fecha nacimiento
            $table->string('especialidad')->nullable();
            // genero
            $table->enum('falta', ['si', 'no'])->nullable();
            // nota acceso
            $table->decimal('salario', 10, 2)->nullable();
            $table->timestamps();
            $table->unique(['nombre', 'apellido']);
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