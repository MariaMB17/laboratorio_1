<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Examenes_subgrupos;
use App\Model\Menu_Usuarios;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu_Usuarios::where('tipousuario',$nivel)->get();
        return view('home',compact('menu'));
    }
    public function menuUsuario($nivel){        
        $menu = Menu_Usuarios::where('tipousuario',$nivel)->get();
        return view('home',compact('menu'));
    }
}
