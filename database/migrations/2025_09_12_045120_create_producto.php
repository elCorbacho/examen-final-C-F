<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 20)->unique();
            $table->string('nombre', 80);
            $table->string('descripcion_corta', 100);
            $table->text('descripcion_larga');
            $table->string('imagen_url', 300)->nullable();
            $table->decimal('precio_neto', 10, 2);
            $table->decimal('precio_con_iva', 10, 2);
            $table->unsignedInteger('stock_actual')->default(0);
            $table->unsignedInteger('stock_minimo')->default(0);
            $table->unsignedInteger('stock_bajo')->default(0);
            $table->unsignedInteger('stock_alto')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
