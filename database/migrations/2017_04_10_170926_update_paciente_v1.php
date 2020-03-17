<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePacienteV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacient', function ($table) {
            $table->string('cedulaPaciente');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('genero');
            $table->string('edad');
            $table->string('detallePaciente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacient', function ($table) {
            $table->dropColumn('cedulaPaciente');
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
            $table->dropColumn('genero');
            $table->dropColumn('edad');
            $table->dropColumn('detallePaciente');
        });
    }
}
