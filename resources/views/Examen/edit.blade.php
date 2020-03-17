@extends('layout.app')
@section('title', 'Editar examen')
@section('content')
<h1>Editar Examenes </h1>
 @foreach ($subgrupos as $subgru)
	{!! Form::model($subgrupos, ['method' => 'PATCH','route' => ['examen.update',$subgru->idexamen]])!!}
	<div class="form-group">
	    {!! Form::label('lbldescripcionex', 'Descripción',array('class'=>'control-label col-xs-2'))!!}
	    <div class="col-xs-10">
	    	{!!Form::text('decripcion',$subgru->decripcion,array('id'=>'decripcion','placeholder'=>'Introduzca descripcion del examen','class'=>'form-control'))!!}
	    </div>
    </div><br><br><br>    
    <div class="form-group" id="capa_rerefencia"><br><br>
		{!! Form::label('lblvalorref', 'Valor de referencia:',array('class'=>'control-label col-xs-2'))!!}
		<div class="col-xs-5"  id="vreferencia_ex">
			{!!Form::text('v_referencia_ex',$subgru->v_referencia_ex,array('id'=>'v_referencia','placeholder'=>'Valor de referencia','class'=>'form-control'))!!}
		</div>
		<div class="col-xs-5"  id="vreferencia_sg">
			{!!Form::text('v_referencia_sg',$subgru->v_referencia_ex,array('id'=>'v_referencia','placeholder'=>'Valor de referencia','class'=>'form-control'))!!}
		</div>
		{!! Form::label('lblprecio', 'Precio:',array('class'=>'control-label col-xs-1'))!!}
		<div class="col-xs-4">
			{!!Form::text('precio',$subgru->precio,array('id'=>'precio','placeholder'=>'precio','class'=>'form-control'))!!}
		</div>
    </div>	
    <div class="form-group">
		<div class="col-xs-offset-2 col-xs-10">
			{!!Form::submit('Modificar',array('id'=>'boton_guardar','class'=>'btn btn-primary'))!!}
		</div>
    </div>    
	 {!! Form::close() !!}
 @endforeach
@endsection

