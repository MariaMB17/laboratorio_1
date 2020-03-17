<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = "pacient";
	protected $fillable=['id','cedulaPaciente','nombres','apellidos','genero','edad','detallePaciente'];
}
