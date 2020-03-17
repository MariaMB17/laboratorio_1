<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
	protected $table = "examenes";
	protected $fillable=['idexamen','decripcion','v_referencia_ex','precio'];
    //

    
}
