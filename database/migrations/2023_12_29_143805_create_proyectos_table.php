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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->string('codigopr', 7);
            $table->string('proyecto',200);
            $table->date('fecha_alta')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->double('importe', 11, 2)->nullable();    
            $table->date('fecha_inicio')->nullable();
            $table->double('coste_personal', 11, 2)->nullable();    
            $table->double('coste_directo', 11, 2)->nullable();    
            $table->double('coste_investigador', 11, 2)->nullable();    
            $table->date('fecha_entrega')->nullable(); ;
            $table->date('cerrado')->nullable(); ;
            $table->string('subvencionada',1);
            $table->string('repartible',1);
            $table->integer('tipologia',2);
            $table->integer('concurrencia',2);
            $table->integer('recurrencia',2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
