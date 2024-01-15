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
        Schema::create('contrato_clientes', function (Blueprint $table) {
            $table->increments('codigo_contrato');
            $table->date('fecha_fin');
            $table->timestamp('fecha_inicio');
            $table->string('contrato', 200);
            $table->date('fecha_entrega');
            $table->double('coste_personal', 12, 2)->nullable();
            $table->double('importe', 12, 2)->nullable();
            $table->double('coste_directo', 12, 2)->nullable();
            $table->double('coste_investigador', 12, 2)->nullable();
            $table->date('entrega')->nullable();
            $table->date('cerrado')->nullable();
            $table->string('entidad', 200)->nullable();
            $table->string('codigopr', 7);
            $table->string('observaciones',4000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_clientes');
    }
};
