<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Examenes_subgrupos extends Model
{
    //
    protected $table = "Examenes_subgrupos";
	protected $fillable=['idexamen','decripcion','descripcion_sg','idgrupo','precio','v_referencia_sg','v_referencia_ex','valor_referencia'];
}
