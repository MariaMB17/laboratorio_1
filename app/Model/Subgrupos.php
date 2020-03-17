<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subgrupos extends Model
{
    protected $table = "examen_subgrupo";
    protected $fillable=['idgrupo','idexamen','descripcion_sg','v_referencia_sg'];

}
