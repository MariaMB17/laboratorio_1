<?php

namespace App\Http\Controllers\Examen;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Examen;
use App\Model\Examenes_subgrupos;
use App\Model\Subgrupos;

class ExamenController extends Controller
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

    
    public function index()
    {
        $subgrupos = Examenes_subgrupos::all();
    	return view('Examen.index',compact('subgrupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Examen.examen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $opcion_existe=$request->input('opcion_subgrupo');
        $examenes = new Examen();
        $subGrupo = new Subgrupos();
        $examen_consubgrupo = 0;
        $buscar= Examen::where('decripcion',$request->input('decripcion'))->get();        
        $b_exam = json_decode($buscar,true);
        if($opcion_existe==2){
             $this->validate($request, [
                'decripcion' => 'required',
                'v_referencia_ex' => 'required',
                'precio' => 'required',
            ]);
        }else{
            $this->validate($request, [
                'decripcion' => 'required',
                'precio' => 'required',
            ]);
            $examen_consubgrupo = $examenes->join('examen_subgrupo', 'examenes.idexamen', '=', 'examen_subgrupo.idexamen')
                                    ->select('examenes.idexamen as idexamen','examenes.decripcion as descripcion_e',
                                            'examenes.precio as precio','examen_subgrupo.idgrupo as idgrupo',
                                            'examen_subgrupo.descripcion_sg as descripcion_sg',
                                            'examen_subgrupo.v_referencia_sg as v_referencia_sg')
                                     ->where('examenes.decripcion',$request->input('decripcion'))->get();
        }
        $descripcion_sg = $request->input('descripcion_sg');
        $codigo_sg = $request->input('id_subgrupo');
        $v_referencia_sg = $request->input('v_referencia_sg');     
        if((count($buscar)>0) && ($opcion_existe==1)){
            if((count($examen_consubgrupo)>0) && ($descripcion_sg!=null)){
                $buscar= Examen::where('decripcion',$request->input('decripcion'))->get();
                $b_exam = json_decode($buscar,true);
                $idexamen = $buscar[0]['idexamen'];
                $subGrupo->insert(['idexamen'=>$idexamen,'descripcion_sg'=>$descripcion_sg,'v_referencia_sg'=>$v_referencia_sg]);
                return redirect()->route('examen.index')->with('success','Los datos fueron procesados con existe');               
            }else{
                return redirect()->route('examen.index')->with('success','El examen: '.$request->input('subgrupo').' ya existe en el subgrupo ');
            }          
        }elseif((count($buscar)==0) && ($opcion_existe==1)){
            $examenes->create($request->all());
            $buscar= Examen::where('decripcion',$request->input('decripcion'))->get();
            $b_exam = json_decode($buscar,true);
            $idexamen = $buscar[0]['idexamen'];
            $subGrupo->insert(['idexamen'=>$idexamen,'descripcion_sg'=>$descripcion_sg,'v_referencia_sg'=>$v_referencia_sg]);
            return redirect()->route('examen.index')->with('success','Los datos fueron procesados con existe');

        }else{
            if(($opcion_existe==2) && (count($buscar)==0)){
                $examenes->create($request->all());
                return redirect()->route('examen.index')->with('success','Los datos fueron procesado con éxito');                
            }           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subgrupos = Examenes_subgrupos::where('decripcion',$id)->get();
        return $subgrupos;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examenes = new Examen();
        $examen_consubgrupo = $examenes->join('examen_subgrupo', 'examenes.idexamen', '=', 'examen_subgrupo.idexamen')
           ->select('examenes.idexamen as idexamen','examenes.decripcion as descripcion_e',
                    'examenes.precio as precio','examen_subgrupo.idgrupo as idgrupo',
                    'examen_subgrupo.descripcion_sg as descripcion_sg',
                    'examen_subgrupo.v_referencia_sg as v_referencia_sg')
                    ->where('examen_subgrupo.idgrupo as idgrupo',$id)->get();
        return view('Examen.edit',compact($examen_consubgrupo));
        //return $id;
    }
    public function editargrupo($id,$idg){
        $examenes = new Examen();
    if($idg>0){
        $subgrupos = $examenes->join('examen_subgrupo', 'examenes.idexamen', '=', 'examen_subgrupo.idexamen')
        ->select('examenes.idexamen as idexamen','examenes.decripcion as decripcion',
        'examenes.precio as precio','examen_subgrupo.idgrupo as idgrupo',
        'examen_subgrupo.descripcion_sg as descripcion_sg',
        'examen_subgrupo.v_referencia_sg as v_referencia_ex')
        ->where('examen_subgrupo.idgrupo',$idg)
        ->where('examenes.idexamen',$id)->get();
    }else{
        $subgrupos= $examenes->select('*')->where('idexamen',$id)->get();
    }
       
        return view('Examen.edit',compact('subgrupos'));
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
        return $request->input('decripcion');
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
}
