<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paciente_Detalle extends Model
{
    protected $table = "detal_pacient";
	protected $fillable=['id','representante','cedula','direccion','telefono','correo','id_paciente'];
}
