<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('email', 50)->unique();
            $table->integer('dni')->unique();
            $table->string('telefono', 20)->nullable();
            $table->integer('numero_legajo')->unique();
            $table->string('estado')->default('activo');
            $table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
