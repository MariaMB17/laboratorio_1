<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu_Usuarios extends Model
{
    protected $table = "menu_usuarios";
	protected $fillable=['mune','nodo','url','tipousuario','usuario'];
}
