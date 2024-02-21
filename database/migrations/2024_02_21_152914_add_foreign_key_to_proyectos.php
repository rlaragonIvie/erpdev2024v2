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
        Schema::table('proyectos', function (Blueprint $table) {
            $table->foreign('cod_tipologia')
            ->references('tipologia')
            ->on('tipologia_proyecto');

            $table->foreign('concurrencia')
            ->references('concurrencia')
            ->on('tipo_concurrencia');

            $table->foreign('recurrencia')
            ->references('recurrencia')
            ->on('tipo_recurrencia');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['tipologia']);
            $table->dropForeign(['concurrencia']);
            $table->dropForeign(['recurrencia']);
        });
    }
};
