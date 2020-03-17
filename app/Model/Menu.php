<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
	protected $fillable=['id','descripcion']
}
