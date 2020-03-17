<?php

namespace App\Http\Controllers\Paciente;

use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Paciente;
use App\Model\Paciente_Detalle;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function rules()
    {
        return [
        'apellidos_paciente' => 'required',
        'nombres_paciente' => 'required',
        'genero_paciente' => 'required|in:F,M',
        'edad_paciente'=> 'required|min:1|max:100',
        'opcion_edad' => 'required|in:M,A',
        'telefono_representante' => 'required',
        'correo_representante'=>'required|email',
        'direccion_representante' => 'required',
        ];
    }
    public function messages()
    {
        return [        
        'apellidos_paciente.required' => 'Los apellidos del paciente son obligatorios',
        'nombres_paciente.required' => 'Los nombres del paciente son obligatorios',
        'genero_paciente.required' => 'Debe seleccionar un genero',
        'edad_paciente.required' => 'Debe colocar la edad del paciente y no debe se menr a 1 y mayor a 100',
        'telefono_representante.required' => 'Debe colocar número de teléfono',
        'correo_representante.required' => 'Debe colocar email',
        'direccion_representante.required' => 'Debe colocar dirección habitacional',        
        ];
    }
     public function rulesAdulto()
    {
        return [
        'cedula_paciente' => 'required',
        ];
    }

    public function messagesAdulto()
    {
        return [        
        'cedula_paciente.required' => 'Debe colocar la cedula del paciente',        
        ];
    }

    public function rulesMenores()
    {
        return [  
        'cedula_paciente' => 'required',      
        'cedula_representante' => 'required',
        'nombresRepresentante' => 'required',
        ];
    }

    public function messagesMenores()
    {
        return [   
        'cedula_paciente.required' => 'Debe colocar la cedula del paciente',      
        'cedula_representante.required' => 'Debe colocar la cedula del representante',
        'nombresRepresentante.required' => 'Debe colocar nombres y apellidos del representante',        
        ];
    }
    

    public function index()
    {
        return view('Pacientes.Paciente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = new Paciente();
        $pacienteDetalles = new Paciente_Detalle();
        $tipoPaciente = $request->input('tipo_paciente');
        $cedulaRepresentante = $request->input('cedula_representante');
        $representante = $request->input('nombres_representante');
        $apellidosPaciente = $request->input('apellidos_paciente');
        $nombresPaciente = $request->input('nombres_paciente');
        $generoPaciente = $request->input('genero_paciente');
        $edadPaciente = $request->input('edad_paciente');
        $opcionEdad = $request->input('opcion_edad');
        $cedulaPaciente = $request->input('cedula_paciente');
        $telefono = $request->input('telefono_representante');
        $correo = $request->input('correo_representante');
        $direccion = $request->input('direccion_representante');
        $idPac = $request->input('idPaciente');
        $buscarDetallepaciente = ($paciente->max('id'))+1;

        
        switch ($tipoPaciente) {    
            case 3:  // si el pacciente es un adulto
                $representante = $nombresPaciente.' '. $apellidosPaciente;
                $cedulaRepresentante = 0; 
                $validator = Validator::make($request->all(),$this->rules(),$this->messages());
                $validatorAdulto = Validator::make($request->all(),$this->rulesAdulto(),$this->messagesAdulto());
                if (($validator->fails()) AND ($validatorAdulto->fails())) {
                     $this->throwValidationException(
                        $request, $validator,$validatorAdulto
                    );
                } else {
                    if($idPac != ""){
                        $cedulaPaciente= $idPac;
                        $detalleBuscar= "pacient.id";
                    } else {
                        $detalleBuscar= "pacient.cedulaPaciente";
                    }
                    $cedulaPac= 0;
                     $buscarPaciente = $paciente->join('detal_pacient', 'pacient.id', '=',
                     'detal_pacient.id_paciente')->select('pacient.id as idPaciente',
                     'pacient.apellidos as apellidos','pacient.nombres as nombre',
                     'detal_pacient.representante as representante','detal_pacient.cedula as cedulaDetalle')
                     ->where('detal_pacient.cedula',$cedulaPac)
                     ->where($detalleBuscar,$cedulaPaciente)->count();             
                }
                break;
            case 1:
                $validator = Validator::make($request->all(),$this->rules(),$this->messages());
                $validatorMenores = Validator::make($request->all(),$this->rulesMenores(),$this->messagesMenores());
                 if (($validator->fails()) AND ($validatorMenores->fails())) {
                     $this->throwValidationException(
                        $request, $validator,$validatorMenores
                    );
                } else {
                    if($idPac != ""){
                        $buscarPaciente = $idPac;
                    } else {
                        $buscarPaciente = 0;
                    }
                    //$buscarPacienteRepresentante = $pacienteDetalles::where('cedula',$cedulaRepresentante)->count();             
                }                
            break;
        }
        if(($buscarPaciente == 0)){
            if($tipoPaciente < 3){
                $cedulaPaciente=$cedulaRepresentante;
            } else {
                $cedulaPaciente = $request->input('cedula_paciente'); 
            }                                 
            $detallePaciente = $buscarDetallepaciente.''.$cedulaRepresentante;
            $paciente->insert(['cedulaPaciente'=>$cedulaPaciente,
                'nombres'=>$nombresPaciente,'apellidos'=>$apellidosPaciente,
                'genero'=>$generoPaciente,'edad'=>$edadPaciente.'-'.$opcionEdad,
                            'detallePaciente'=>$detallePaciente]);
            $buscarIdPacciente = Paciente::where('detallePaciente',$detallePaciente)->get();
            $b_IP = json_decode($buscarIdPacciente,true);
            $idPaciente = $buscarIdPacciente[0]['id'];
            $pacienteDetalles->insert(['representante'=>$representante,
                'cedula'=>$cedulaRepresentante,'direccion'=>$direccion,
                'telefono'=>$telefono,'correo'=>$correo,'id_paciente'=>$idPaciente]);
        } else {
            if ($tipoPaciente == 3){                
                $Ncedula_paciente= $request->input('nueva_cedula_paciente');
                $detallePaciente= $idPac.''.$cedulaRepresentante;
            } else {
                $Ncedula_paciente= $request->input('nueva_cedula_representante');
                $detallePaciente= $idPac.''.$cedulaRepresentante;
            }
            $idPacienteUpdate = $request->input('idPaciente');
            $idPacienteDetalleUpdate = $request->input('idPacienteDetalle');
            $modificarPaciente = Paciente::where('id',$idPacienteUpdate)
                                 ->update(['cedulaPaciente'=>$Ncedula_paciente,
                                          'nombres'=>$nombresPaciente,
                                          'apellidos'=>$apellidosPaciente,
                                          'genero'=>$generoPaciente,
                                          'edad'=>$edadPaciente.'-'.$opcionEdad,
                                          'detallePaciente'=>$detallePaciente]);
            $modificarPaciente_detal =Paciente_Detalle::where('id_paciente',$idPacienteUpdate)
                                      ->update(['representante'=>$representante,
                                                'cedula'=>$cedulaRepresentante,
                                                'direccion'=>$direccion,
                                                'telefono'=>$telefono,
                                                'correo'=>$correo]);
            
        }              
        $datos_grupo = $request->only('tipo_paciente', 'apellidos_paciente');

        ///if ($validator->fails()) {
           //$this->throwValidationException(
             //   $request, $validator
                 /*return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();*/
            //);
       // }
        return view('Pacientes.Paciente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarPacientes_Representante ($id,$idRepresentante) {
        $paciente = new Paciente();
        $pacienteDetalles = new Paciente_Detalle();
        switch ($id) {
            case 1:
                $buscarPacienteRepresentante = $pacienteDetalles::where('cedula',$idRepresentante)->count();
                if($buscarPacienteRepresentante > 0 ){
                    $pacienteRepresentantes = $paciente->join('detal_pacient', 'pacient.id', '=',
                     'detal_pacient.id_paciente')->select('pacient.id as idPaciente',
                     'detal_pacient.cedula as cedulaPD',
                     'pacient.cedulaPaciente as cedulaPaciente',                     
                     'pacient.apellidos as apellidos','pacient.nombres as nombre',
                     'detal_pacient.direccion as direccion', 'detal_pacient.telefono as telefono',
                     'detal_pacient.correo as correo', 'detal_pacient.representante as representante',
                     'detal_pacient.cedula as cedulaDetalle')
                     ->where('detal_pacient.cedula',$idRepresentante)->get();
                 }else {
                    $pacienteRepresentantes = 0;
                }
                return $pacienteRepresentantes;
            break;
            case 2:
                 $buscarPaciente = $paciente::where('id',$idRepresentante)->count();
                 if($buscarPaciente > 0 ){
                    $datosPaciente = $paciente->join('detal_pacient', 'pacient.id', '=',
                     'detal_pacient.id_paciente')->select('pacient.id as id',
                     'pacient.cedulaPaciente as cedulaPaciente',
                     'pacient.nombres as nombres','pacient.apellidos as apellidos',
                     'pacient.genero as genero','pacient.edad as edad',
                     'pacient.detallePaciente as detallePaciente',
                     'detal_pacient.representante as representante',
                     'detal_pacient.direccion as direccion', 'detal_pacient.telefono as telefono',
                     'detal_pacient.correo as correo')
                     ->where('pacient.id',$idRepresentante)->get();
                 } else {
                  $datosPaciente = 0;  
                 }
                 return $datosPaciente;
            break; 
            case 3:  /* Buscar solamente cuando el paciente es adulto */
                 $buscarPacienteAdulto = $paciente::where('cedulaPaciente',$idRepresentante)->count();
                 if($buscarPacienteAdulto > 0 ){
                    $datosPacienteAdulto = $paciente->join('detal_pacient', 'pacient.id', '=',
                     'detal_pacient.id_paciente')->select('pacient.id as id',
                     'pacient.cedulaPaciente as cedulaPaciente',
                     'pacient.nombres as nombres','pacient.apellidos as apellidos',
                     'pacient.genero as genero','pacient.edad as edad',
                     'pacient.detallePaciente as detallePaciente',
                     'detal_pacient.representante as representante',
                     'detal_pacient.cedula as cedulaPD',
                     'detal_pacient.direccion as direccion', 'detal_pacient.telefono as telefono',
                     'detal_pacient.correo as correo')
                     ->where('pacient.cedulaPaciente',$idRepresentante)
                     ->where('detal_pacient.cedula','0')->get();
                 } else {
                  $datosPacienteAdulto = 0;  
                 }
                 return $datosPacienteAdulto;
            break;              
        }   
        
        

    }
}
