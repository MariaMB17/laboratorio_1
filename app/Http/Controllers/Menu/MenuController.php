<?php

namespace App\Http\Controllers\Menu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Model\Menu_users;
use App\Model\Examenes_subgrupos;
class MenuController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    	$subgrupos = Examenes_subgrupos::all();
    	return view('Menu.index',compact('subgrupos'));
    }
    public function mostrar(){
        
    }

}
