<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->char('rut_empresa', 12)->unique();
            $table->string('rubro', 50);
            $table->string('razon_social', 150);
            $table->string('telefono', 20);
            $table->string('direccion', 200);
            $table->string('contacto_nombre', 70);
            $table->string('contacto_correo', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
