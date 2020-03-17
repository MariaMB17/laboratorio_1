<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDetallePacienteV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detal_pacient', function ($table) {
            $table->string('representante',200);
            $table->string('cedula',13);
            $table->string('direccion',255);
            $table->string('telefono',12);
            $table->string('correo',250);
            $table->integer('id_paciente')->unsigned();
            $table->foreign('id_paciente')->references('id')->on('pacient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detal_pacient', function ($table) {
            $table->dropColumn('representante');
            $table->dropColumn('cedula');
            $table->dropColumn('direccion');
            $table->dropColumn('telefono');
            $table->dropColumn('correo');
            $table->dropColumn('id_paciente');
        });
    }
}
