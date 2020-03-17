@extends('layout.app')
@section('title', 'Examenes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Examenes</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        {!! Form::open(array('route' => 'examen.store','method'=>'POST','class'=>'form-horizontal')) !!}
                            <div class="form-group">
                                {!! Form::label('lbldescripcionex', 'Descripción',array('class'=>'control-label col-xs-2'))!!}
                                <div class="col-xs-10">
                                    {!!Form::text('decripcion',null,array('id'=>'decripcion','placeholder'=>'Introduzca descripcion del examen','class'=>'form-control'))!!}       
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('lblsgrup', 'Tiene subgrupo:',array('class'=>'control-label col-xs-2'))!!}
                                <div class="col-xs-4">
                                    {!!Form::select('opcion_subgrupo', ['0' => 'Seleccione una opción', '1' => 'Si', '2'=>'No'], 'S',array('class'=>'form-control','id'=>'opcion_subgrupo'));!!}
                                </div>
                            </div>
                            <div class="form-group" id="capa_subgrupo">
                               {!! Form::label('lblsubgrupo', 'Sub-grupos:',array('class'=>'control-label col-xs-2'))!!}
                               <div class="col-xs-8">
                                   <select class="form-control" id="id_subgrupo" name="id_subgrupo"></select>
                               </div>
                               <a  id="registrar_subgrupo" name="registrar_subgrupo">Registrar subgrupo</a>                                
                            </div>
                             <div class="form-group" id="capa_descripcionsubgrupo">
                                {!! Form::label('lblddessubgrupo', 'Descripción:',array('class'=>'control-label col-xs-2'))!!}
                                <div class="col-xs-8">
                                    {!!Form::text('descripcion_sg',null,array('id'=>'descripcion_sg','placeholder'=>'Introduzca descripcion del subgrupo','class'=>'form-control'))!!}
                                </div>
                                <a id="no_registrar_subgrupo" name="no_registrar_subgrupo">Ya existe el subgrupo</a>
                            </div>
                            <div id="capa_rerefencia">
                                <div class="form-group">
                                    {!! Form::label('lblvalorref', 'Valor de referencia:',array('class'=>'control-label col-xs-2'))!!}
                                    <div class="col-xs-5"  id="vreferencia_ex">
                                        {!!Form::text('v_referencia_ex',null,array('id'=>'v_referencia','placeholder'=>'Valor de referencia','class'=>'form-control'))!!}
                                    </div>
                                    <div class="col-xs-5"  id="vreferencia_sg">
                                        {!!Form::text('v_referencia_sg',null,array('id'=>'v_referencia','placeholder'=>'Valor de referencia','class'=>'form-control'))!!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('lblprecio', 'Precio:',array('class'=>'control-label col-xs-2'))!!}
                                    <div class="col-xs-4">
                                        {!!Form::text('precio',null,array('id'=>'precio','placeholder'=>'precio','class'=>'form-control'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('unit_id_in', null, ['class' => 'form-control', 'id' => 'select2']) !!}
                            </div>
                            <div class="form-group">
                             <label for="tags" class="control-label">Tags</label>
                             <select name="tags[]" class="form-control" multiple="multiple" id="tags"></select>
                            </div>
                         
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    {!!Form::submit('Enviar',array('id'=>'boton_guardar','class'=>'btn btn-primary'))!!}
                                </div>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript"src="../jquery/jquery.min.js"></script>
<script>   
$(document).ready(function(){
    $("#capa_rerefencia").hide();
    $("#capa_subgrupo").hide();
    $("#capa_descripcionsubgrupo").hide();
    $("#vreferencia_sg").hide();
    $("#boton_guardar").attr('disabled',true);
    $("#opcion_subgrupo").change(function () {
        var opcion = $('#opcion_subgrupo').val();
        if(opcion==1){
            $("#capa_rerefencia").show();
            $("#capa_subgrupo").show();
            $("#capa_descripcionsubgrupo").hide();
            $("#vreferencia_ex").hide();
            $("#vreferencia_sg").show();
            $("#boton_guardar").attr('disabled',false);
            $.get("{{ url('examen/')}}"+'/'+($("#decripcion").val()),
            function(data) {
                $('#id_subgrupo').empty();
                $.each(data, function(i) {
                    $('#id_subgrupo').append("<option value='"+ data[i].idexamen +"'>" + data[i].descripcion_sg + "</option>");
                });
            });
        }else if(opcion==2){
            $("#capa_rerefencia").show();
            $("#capa_subgrupo").hide();
            $("#capa_descripcionsubgrupo").hide();
            $("#vreferencia_ex").show();
            $("#vreferencia_sg").hide();
            $("#boton_guardar").attr('disabled',false);
        }else{
            $("#capa_rerefencia").hide();
            $("#capa_subgrupo").hide();
            $("#capa_descripcionsubgrupo").hide();
            $("#vreferencia_sg").hide();
            $("#boton_guardar").attr('disabled',true);
        }
    })
    $("#registrar_subgrupo").click(function(){
        $("#capa_subgrupo").hide();
        $("#capa_descripcionsubgrupo").show();
    })
    $("#no_registrar_subgrupo").click(function(){
        $("#capa_subgrupo").show();
        $("#capa_descripcionsubgrupo").hide();
    })
})    
</script>


