<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});






Route::auth();
Route::group(['middleware' => 'auth'], function () {
Route::get('home', 'HomeController@index');
Route::get('home/{nivel}', 'HomeController@menuUsuario');
Route::resource('examen', 'Examen\ExamenController');
Route::resource('menu', 'Menu\MenuController');
Route::resource('paciente', 'Paciente\PacienteController');
Route::get('examen/{ide}/{idg}','Examen\ExamenController@editargrupo');
Route::get('paciente/{id}/{idRepresentante}','Paciente\PacienteController@buscarPacientes_Representante');
});
