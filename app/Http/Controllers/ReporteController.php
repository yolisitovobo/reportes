<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Staff;
use Barryvdh\Debugbar\Twig\Extension\Dump;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Support\Facades\Mail;

class ReporteController extends Controller
{
      public function solicitud(Request $request){
        $usuario = $request->session()->get('usuario');
        if(empty($usuario)){
            return redirect()->to('/');
        }
       if($request->isMethod('post')){
            $request->validate([
                'id_area' => 'required',
                'id_staff' => 'required',
                'id_usuario' => 'required',
                'tipo_equipo' => 'required',
                'des_proble' => 'required',
            ]);

            $id_reporte=Reporte::select('id_reporte')->max('id_reporte');
            $id_reporte++;
            $data = $request->all();
            $data['fecha_repor']=Carbon::now();
            $data['serv_con']='1';
            $intentos=3;
            do{
                $conteo=Reporte::where ('id_reporte',$id_reporte)->count();
                if($conteo != 0){
                    $intentos--;
                }else{
                    $data['id_reporte']=$id_reporte;
                    $reporte = new Reporte($data);
                    $reporte->save();
                    $mensaje="Su reporte fué registrado correctamente, con el número $id_reporte";
                    return redirect()->route('detalle-reporte',['id'=>$id_reporte,'ref'=>'rep_fin'])->with('success', $mensaje);

                    break;
                }

            }while($intentos > 0 );
            if($intentos == 0){
                throw ValidationException::withMessages(['id_staff' => 'Ocurrió un error, intentalo nuevamente']);
            }
       }

        $usuarios=Staff::select('staff_id','staff_nombre', 'staff_subgpo','staff_gpo', 'staff_sda');
        $departamentos=Staff::select('staff_sda','staff_subgpo')->distinct();

        if((substr($usuario['staff_atrib'],0,1)) == 1){
            $usuarios -> where('staff_gpo',$usuario['staff_gpo']);
            $departamentos-> where ('staff_subgpo',$usuario['staff_subgpo']);
         }

         $departamentos=$departamentos->orderBy('staff_sda', 'asc')->get();

            $usuarios=$usuarios->orderBy('staff_nombre', 'asc')->get()->mapWithKeys(function ($items,$key){
            return [
                $items->staff_id => [
                    'staff_id' => $items->staff_id,
                    'staff_nombre' => utf8_encode($items->staff_nombre),
                    'staff_subgpo' => $items->staff_subgpo,
                    'staff_gpo' => $items->staff_gpo,
                    'staff_sda' => $items->staff_sda,
                ]
            ];
        })->toArray();

        $usuario_equipo=$usuarios;
        if((substr($usuario['staff_atrib'],0,1)) == 1){

            $usuarios_tem[$usuario['staff_id']]=$usuarios[$usuario['staff_id']];
            $usuario['staff_atrib']=$usuarios[$usuario['staff_id']];
            $usuarios=$usuarios_tem;
            unset ($usuarios_tem);
        }
        $us_reg=utf8_encode($usuario['staff_nombre']);
        $equipos = config('equipo');
        $fecha=Carbon::now();

        return view('reportes.reporte',compact('usuarios','equipos','usuario_equipo', 'departamentos','fecha','us_reg','usuario'));

    }

    public function detalle(Request $request, $id, $tipo){
        $datos=$this->datos_detalle($id);
            $user_log=session('usuario');
            $user_db='';
            $usuario['staff_atrib']=substr($user_log['staff_atrib'],0,1);
            $usuario['id_staff_ati']=$datos['reporte']['id_staff_ati'];
            if((substr($user_log['staff_atrib'],0,1)) < 3 && !empty($datos)){
                $user_db=$datos['reporte']['id_staff'];
                $user_db_nom=utf8_encode($datos['us_rep'][0]['staff_nombre']);
            }
            elseif( !empty($datos)){
                //$user_db=$datos['reporte']['id_staff_ati'];
                //$user_db_nom=$datos['reporte']['tec_asig'];
                $user_db=$user_log['staff_id'];
                $user_db_nom=utf8_encode($user_log['staff_nombre']);
            }
            if(!empty($datos)){
                $reporte=$datos['reporte'];
                $us_rep=$datos['us_rep'];
                $us_equ=$datos['us_equ'];
                $equ=$datos['equ'];
                $fecha=$datos['fecha'];
                if($tipo != 'imprimir'){
                    return view('reportes.detalle', compact('reporte','us_rep','us_equ','equ','fecha','tipo','user_db_nom','usuario','user_db'));
                }else{
                    $pdf = PDF::loadView('reportes.imprime', compact('reporte','us_rep','us_equ','equ','fecha','tipo','user_db_nom'))
                    ->setOptions(['isRemoteEnabled' => true, 'defaultFont' => 'sans-serif', 'defaultMediaType' => 'print', 'chroot' => public_path()]);                   return ($pdf->stream());
                }
            }else{
                return redirect()->to('./consulta');
            }
    }

    protected function datos_detalle($id){
        $datos=[];
        $edo_reporte=config('servicio');
        $reporte['serv_con']=1;
        $reporte = Reporte::find($id);
        if(!empty($reporte)){
            if (empty(trim($reporte['serv_con']))){$reporte['serv_con']=1;}
            $reporte['edo_reporte']=$edo_reporte[$reporte['serv_con']];
            $reporte['des_proble']= utf8_encode($reporte['des_proble']);
            $reporte['des_sol']=utf8_encode($reporte['des_sol']);
            $reporte['des_tra']=utf8_encode($reporte['des_tra']);
            $reporte['tec_asig']='No asignado';
            $datos['id_tecnico']=$reporte['id_staff_ati'];
            $datos['us_rep']=Staff::select('staff_nombre', 'staff_sda')->where('staff_id',$reporte['id_staff'])->get();
            $datos['us_equ']=Staff::select('staff_nombre')->where('staff_id',$reporte['id_usuario'])->get();
            $tec_asig=Staff::select('staff_nombre')->where('staff_id',$reporte['id_staff_ati'])->get()->toArray();
            if(isset($tec_asig[0]['staff_nombre'])){
                $reporte['tec_asig']=utf8_encode($tec_asig[0]['staff_nombre']);
            }
            $equipos = config('equipo');
            $datos['equ']=$equipos[$reporte['tipo_equipo']];
            $datos['fecha']=Carbon::createFromFormat('Y-m-d H:i:s', $reporte['fecha_repor'])->format('d/m/Y H:i');
            $datos['reporte']=$reporte;
        }
        return($datos);

    }

    public function consulta(Request $request){
        $usuarios = $request->session()->get('usuario');
        $usuario=[];
        $usuario=$usuarios;
        $usuario['staff_nombre']=utf8_encode($usuarios['staff_nombre']);
            $rep_final=[];
            $reportes=DB::table('reportes')
            ->join('e_staff','e_staff.staff_id','=','reportes.id_usuario')
            ->select('reportes.id_reporte', 'e_staff.staff_nombre','e_staff.staff_sda','reportes.tipo_equipo','reportes.fecha_repor','reportes.id_staff_ati','reportes.serv_con')
            ->where('serv_con','<>','5');
            if(substr($usuario['staff_atrib'],0,1) >= 3 ){
                $reportes=$reportes->where('reportes.id_staff_ati',$usuario['staff_id']);
            }
            if((substr($usuario['staff_atrib'],0,1)) < 3){
                $reportes=$reportes->where('reportes.id_staff',$usuario['staff_id']);
            }else{
                $reportes=$reportes->where('reportes.id_staff_ati',$usuario['staff_id']);
            }
            $reportes=$reportes->orderByDesc('reportes.id_reporte')
            ->get();
            $cont=0;
            $equipos = config('equipo');
            $edo_reporte=config('servicio');
                foreach ($reportes as $repo){
                    if($repo->id_staff_ati <> null){
                        $tec_asig= Staff::select('staff_nombre')->where('staff_id',$repo->id_staff_ati)->get()->toArray();
                        $tec=(!isset($tec_asig['0']['staff_nombre'])) ? '' : utf8_encode($tec_asig['0']['staff_nombre']);
                    }else{$tec=null;}
                    $rep_final[$cont]['id_reporte']=$repo->id_reporte;
                    $fecha=Carbon::parse($repo->fecha_repor);
                    $repo->fecha_repor=$fecha->format('d/m/Y H:i');
                    $rep_final[$cont]['area_dpto']=$repo->staff_sda;
                    $rep_final[$cont]['us_equipo']=utf8_encode($repo->staff_nombre);
                    $rep_final[$cont]['equ_prob']=$equipos[$repo->tipo_equipo];
                    $rep_final[$cont]['fecha_repo']=$repo->fecha_repor;
                    $rep_final[$cont]['tecnico']=$tec;
                    $rep_final[$cont]['edo_repo']=$edo_reporte[$repo->serv_con];
                    $cont++;
                }
        return view('reportes.consulta', compact('usuario','rep_final'));
    }

    public function crea_pdf(Request $request){



    }

    public function actualiza(Request $request,$id){
        if($request->isMethod('post')){
            $request->validate([
                'marca' => 'required_if:serv_con,2',
                'modelo'=> 'required_if:serv_con,2',
                'no_inve' => 'required_if:serv_con,2',
                'no_serie'=> 'required_if:serv_con,2',
                'des_sol' => 'required_if:serv_con,2',
            ]);
            $datos_rep=Reporte::find($request['id']);
            $datos_rep->des_tra=utf8_decode(trim($request['des_tra']));
            $datos_rep->marca=utf8_decode(trim($request['marca']));
            $datos_rep->modelo=utf8_decode(trim($request['modelo']));
            $datos_rep->no_inve=utf8_decode(trim($request['no_inve']));
            $datos_rep->no_serie=utf8_decode(trim($request['no_serie']));
            $datos_rep->des_sol=utf8_decode(trim($request['des_sol']));
            $datos_rep->serv_con=$request['serv_con'];
            $datos_rep->fecha_inicio = ($datos_rep->fecha_inicio) ?? Carbon::now();
            if($datos_rep->save()){
                return redirect()-> route('detalle-reporte',['id'=>$request['id'],'ref'=>'rep_vista'])->with('success','Su reporte ha sido actualizado.');
            }
        }

        $datos=$this->datos_detalle($id);
        $user_log=session('usuario');
        $user_db='';
        $usuario['staff_atrib']=substr($user_log['staff_atrib'],0,1);
        if((substr($user_log['staff_atrib'],0,1)) < 3 && !empty($datos)){
            $user_db=$datos['reporte']['id_staff'];
            $user_db_nom=utf8_encode($datos['us_rep'][0]['staff_nombre']);
        }
        elseif( !empty($datos)){
            $user_db=$datos['reporte']['id_staff_ati'];
            $user_db_nom=$datos['reporte']['tec_asig'];
        }
        if($user_log['staff_id'] == $user_db and  !empty($datos)){
            $reporte=$datos['reporte'];
            $us_rep=$datos['us_rep'];
            $us_equ=$datos['us_equ'];
            $equ=$datos['equ'];
            $fecha=$datos['fecha'];
            return view('reportes.actualiza', compact('reporte','us_rep','us_equ','equ','fecha','user_db_nom','usuario'));
        }else{
            return redirect()->to('./consulta');

        }
    }


}
