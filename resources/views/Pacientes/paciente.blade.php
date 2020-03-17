@extends('layout.app')
@section('title', 'Registro de Pacientes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Datos del Paciente</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        @if(count($errors) > 0)
                        <div class="errors">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        {!!Form::open(array('route' => 'paciente.store','method'=>'POST','class'=>'form-horizontal','id'=>'frmPaciente'))!!}
                        <div class="form-group">
                            {!! Form::label('lbltipoPaciente','Tipo de paciente:',array('class'=>'control-label col-sm-2'))!!}
                            <div class="col-sm-3">
                                {!!Form::select('tipo_paciente', ['0' => 'Seleccione una opción', '1' => 'Niño/Adolescente','3'=>'Adulto'], '0',array('class'=>'form-control','id'=>'tipo_paciente'));!!}
                            </div>
                        </div>
                        <div id="datosPaciente">
                            <div id="datosRepresentantes">
                                <h1>Datos del Representante </h1>
                                 <div class="form-group">
                                    {!!Form::label('cedulaRepresentante','Cédula:',array('class'=>'col-sm-2 control-label'))!!}
                                    <div class="col-sm-3">
                                    {!!Form::text('cedula_representante',null,array('class'=>'form-control','id'=>'cedula_representante'))!!}
                                    </div> 
                                     {!!Form::label('lblNuevacedulaRepresentante','Nueva nro de Cédula:',array('class'=>'col-sm-2 control-label','id'=>'lblnueva_cedula_representante'))!!}
                                <div class="col-sm-3">
                                {!!Form::text('nueva_cedula_representante',null,array('class'=>'form-control','id'=>'nueva_cedula_representante'))!!}
                                </div>                       
                                </div>
                                <div class="form-group">
                                    {!!Form::label('nombresRepresentante','Nombres y apellidos:',array('class'=>'col-sm-2 control-label'))!!}
                                    <div class="col-sm-9">
                                    {!!Form::text('nombres_representante',null,array('class'=>'form-control','id'=>'nombres_representante','spellsheck'=>'true'))!!}
                                    </div>                        
                                </div>
                                <div class="form-group" id="pacienteRepresentante">
                                {!! Form::label('lblgeneroPacienteR','Seleccione Paciente:',array('class'=>'control-label col-sm-2'))!!}
                                <div class="col-sm-9">
                                     <select name="select_pacientes" id="select_pacientes" class="form-control requerido"></select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <h1>Datos del paciente </h1>
                                {!!Form::label('lblApellidos','Apellidos:',array('class'=>'col-sm-2 control-label'))!!}
                                <div class="col-sm-4 ">
                                {!!form::text('apellidos_paciente',old('apellidos_paciente'),array('class'=>'form-control requerido','id'=>'apellidos_paciente'))!!} 
                                </div>
                                {!!Form::label('lblNombres','Nombres:',array('class'=>'col-sm-1 control-label'))!!}
                                <div class="col-sm-4 {{ $errors->has('nombres_paciente') ? ' has-error' : '' }}">
                                    {!!form::text('nombres_paciente',old('nombres_paciente'),array('class'=>'form-control requerido','id'=>'nombres_paciente'))!!}
                                </div>                 
                            </div>
                            <div class="form-group">
                                {!! Form::label('lblgeneroPaciente','Sexo:',array('class'=>'control-label col-sm-2'))!!}
                                <div class="col-sm-4">
                                    {!!Form::select('genero_paciente', ['0' => 'Seleccione una opción', 'F' => 'Femennino', 'M'=>'Masculino'], '0',array('class'=>'form-control requerido','id'=>'genero_paciente'));!!}
                                </div>
                                {!! Form::label('lbledadPaciente','Edad :',array('class'=>'control-label col-sm-1'))!!}
                                <div class="col-sm-2">
                                     {!!form::number('edad_paciente',null,array('class'=>'form-control requerido','id'=>'edad_paciente','min'=>'1','max'=>'100'))!!}
                                </div> 
                                 <div class="col-sm-2">
                                    {!!Form::select('opcion_edad', ['0' => 'Seleccione', 'M' => 'Mes', 'A'=>'Año'], '0',array('class'=>'form-control requerido','id'=>'opcion_edad'));!!}
                                </div>                                               
                            </div>
                             <div class="form-group" id="cedulaPaciente">
                                {!!Form::label('cedulaPaciente','Cédula:',array('class'=>'col-sm-2 control-label'))!!}
                                <div class="col-sm-3">
                                {!!Form::text('cedula_paciente',null,array('class'=>'form-control','id'=>'cedula_paciente'))!!}
                                </div> 
                                {!!Form::label('lblNuevacedulaPaciente','Nueva nro de Cédula:',array('class'=>'col-sm-2 control-label','id'=>'lblnueva_cedula_paciente'))!!}
                                <div class="col-sm-3">
                                {!!Form::text('nueva_cedula_paciente',null,array('class'=>'form-control','id'=>'nueva_cedula_paciente'))!!}
                                </div>
                                <div class="col-sm-6"> 
                                <p id="parrafo">Si el paciente no posee cédula colocar 0</p>
                                </div>                                                        
                            </div>                        
                             <div class="form-group">
                                {!!Form::label('lbltelefono','Télefono:',array('class'=>'col-sm-2 control-label'))!!}
                                <div class="col-sm-4">
                                {!!form::text('telefono_representante',null,array('class'=>'form-control','id'=>'telefono_representante'))!!} 
                                </div>
                                {!!Form::label('lblCorreo','Correo :',array('class'=>'col-sm-1 control-label'))!!}
                                <div class="col-sm-4">
                                    {!!form::email('correo_representante',null,array('class'=>'form-control requerido','id'=>'correo_representante'))!!}
                                </div>                 
                            </div>
                            <div class="form-group">
                                {!!Form::label('direccionRepresentante','Dirección:',array('class'=>'col-sm-2 control-label'))!!}
                                <div class="col-sm-9">
                                {!!Form::textarea('direccion_representante',null,array('class'=>'form-control requerido','id'=>'direccion_representante','spellsheck'=>'true'))!!}
                                </div>                        
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                {!!Form::hidden('idPacienteDetalle',null,array('class'=>'form-control requerido','id'=>'idPacienteDetalle'))!!}
                                {!!Form::hidden('idPaciente',null,array('class'=>'form-control requerido','id'=>'idPaciente'))!!}
                                </div>                        
                            </div>
                             <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    {!!Form::submit('Enviar',array('id'=>'boton_guardar','class'=>'btn btn-primary'))!!}
                                    {{ Form::reset('Cancelar',array('id'=>'boton_limpiar','class'=>'btn btn-primary')) }}
                                </div>
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
<script type="text/javascript" src="./jquery/jquery.min.js"></script>.
<script type="text/javascript" src="./jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="./jquery/additional-methods.min.js"></script>
<script type="text/javascript">   
$(document).ready(function(){
    $('#datosPaciente').hide();
    $('#datosRepresentantes').hide();
    $('#cedulaPaciente').hide();
    $('#pacienteRepresentante').hide();
    $('#nueva_cedula_paciente').hide();
    $('#lblnueva_cedula_paciente').hide();
    $('#lblnueva_cedula_representante').hide();
    $('#nueva_cedula_representante').hide();
    $("#frmPaciente").validate({
        debug: false,
        rules:{
            tipo_paciente : {
                selectcheck: true
            },
            apellidos_paciente:{
                required: true
            },
            nombres_paciente: {
                required: true
            },
            edad_paciente : {
                required: true,
                min:1,
                max:100
            },
            telefono_representante : {
                required : true
            },
            correo_representante : {
                required : true
            },
            direccion_representante : {
                required : true
            },
            genero_paciente: {
                selectcheck: true
            },
            opcion_edad: {
                selectcheck: true
            }
        },
        messages: {
            apellidos_paciente: {
                required: "Introduce apellidos del paciente."
            },
            nombres_paciente: {
                required : "Introduce los nombres del paciente."
            },
            edad_paciente : {
                required: 'Introduce la edad.',
                min:'El menor número permitido es 1',
                max:'El mayor número permitido es 100'
            },
            telefono_representante : {
                required : 'Introduce el número de teléfono'
            },
            correo_representante : {
                required : 'Introduce el correo eléctronico.'
            },
            direccion_representante : {
                required : 'Introduce dirección habitacional.'
            }
        },
        
    });
    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "Debe selecionar unas de las opciones.");
    $('#tipo_paciente').change(function(){
        var opcion = $('#tipo_paciente').val();
        $('#datosPaciente').show();
        if(opcion == 3){
            $('#datosRepresentantes').hide();
            $('#cedulaPaciente').show();
            $('#opcion_edad').val("");
            $('#edad_paciente').val("");
            $('#parrafo').hide();
        }else {
            $('#datosRepresentantes').show();
            $('#cedulaPaciente').hide();
            $('#parrafo').show();
        }
    });
    $('#opcion_edad').change(function(){
        var opcionEdad = $('#opcion_edad').val();
        var edadPaciente = $('#edad_paciente').val();
        if((opcionEdad == 'A') && ((edadPaciente >= 10))){
            $('#cedulaPaciente').show();
        }else{
            $('#cedulaPaciente').hide();
        }
    })
    $('#cedula_paciente').change(function(){
        $.get("{{ url('paciente/')}}"+'/'+'3'+'/'+($("#cedula_paciente").val()),
            function(data) {
                console.log(data);
                if(data != 0 ){
                    $.each(data, function(i) {
                        if (data[i].cedulaPD == 0) {
                            $('#lblnueva_cedula_paciente').show();
                            $('#nueva_cedula_paciente').show();
                            $('#apellidos_paciente').val(data[i].apellidos);
                            $('#nombres_paciente').val(data[i].nombres);
                            $('#genero_paciente').val(data[i].genero);
                            var edadPaciente = data[i].edad.split('-');
                            $('#edad_paciente').val(edadPaciente[0]);
                            $('#opcion_edad').val(edadPaciente[1]);
                            $('#telefono_representante').val(data[i].telefono);
                            $('#correo_representante').val(data[i].correo);
                            $('#direccion_representante').val(data[i].direccion);
                            $('#idPacienteDetalle').val(data[i].detallePaciente);
                            $('#idPaciente').val(data[i].id);
                            $('#nueva_cedula_paciente').val(data[i].cedulaPaciente);

                        }
                    });                   
                }else {
                    $('#apellidos_paciente').val('');
                    $('#nombres_paciente').val('');
                    $('#genero_paciente').val('');                   
                    $('#edad_paciente').val('');
                    $('#opcion_edad').val('');
                    $('#telefono_representante').val('');
                    $('#correo_representante').val('');
                    $('#direccion_representante').val('');
                    $('#idPacienteDetalle').val(''); 
                    $('#nueva_cedula_paciente').val('');
                    $('#nueva_cedula_paciente').hide();
                    $('#lblnueva_cedula_paciente').hide();                  
                }
        });
    });
    $('#cedula_representante').change(function(){
        $.get("{{ url('paciente/')}}"+'/'+'1'+'/'+($("#cedula_representante").val()),
            function(data) {
                if(data != 0 ){
                    $('#select_pacientes').empty();
                    $('#select_pacientes').append("<option value='0'>Seleccione un paciente </option>");                    
                    $.each(data, function(i) {                       
                        if (data[i].cedulaDetalle > 0) {
                        $('#lblnueva_cedula_representante').show();
                        $('#nueva_cedula_representante').show();
                        $('#nueva_cedula_representante').val(data[0].cedulaPD); 
                        $('#nombres_representante').val(data[0].representante);                                   
                        $('#select_pacientes').append("<option value='"+ data[i].idPaciente +"'>" + data[i].apellidos +' '+ data[i].nombre + "</option>");
                        $('#telefono_representante').val(data[0].telefono);
                        $('#correo_representante').val(data[0].correo);
                        $('#direccion_representante').val(data[0].direccion);
                        $('#pacienteRepresentante').show();
                        }
                    }); 
                }else {
                    alert('El representante no tiene pacientes registrados');
                    $('#pacienteRepresentante').hide();
                    $('#select_pacientes').empty();
                    $('#nombres_representante').val('');
                    $('#nueva_cedula_representante').val('');
                    $('#telefono_representante').val('');
                    $('#correo_representante').val('');
                    $('#direccion_representante').val(''); 
                    $('#lblnueva_cedula_representante').hide();
                    $('#nueva_cedula_representante').hide();
                }
            });
    });
    $('#select_pacientes').change(function(){
        var idPaciente = $('#select_pacientes').val();
        $.get("{{ url('paciente/')}}"+'/'+'2'+'/'+idPaciente,
            function(data) {
                if(data != 0 ){
                    $('#apellidos_paciente').val(data[0].apellidos);
                    $('#nombres_paciente').val(data[0].nombres);
                    $('#genero_paciente').val(data[0].genero);
                    var edadPaciente = data[0].edad.split('-');
                    $('#edad_paciente').val(edadPaciente[0]);
                    $('#opcion_edad').val(edadPaciente[1]);
                    $('#idPacienteDetalle').val(data[0].detallePaciente);
                    $('#idPaciente').val(data[0].id);

                } else {
                    $('#apellidos_paciente').val('');
                    $('#nombres_paciente').val('');
                    $('#genero_paciente').val('');                   
                    $('#edad_paciente').val('');
                    $('#opcion_edad').val('');
                    $('#telefono_representante').val('');
                    $('#correo_representante').val('');
                    $('#direccion_representante').val('');
                    $('#idPacienteDetalle').val('');
                }                
            });
    });
})    
</script>
 
