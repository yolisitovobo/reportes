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

class AdministradorController extends Controller
{
    public function datos(Request $request){
        $usuarios = $request->session()->get('usuario');
        $usuario=[];
        $usuario=$usuarios;
        $usuario['staff_nombre']=utf8_encode($usuarios['staff_nombre']);
            $rep_final=[];
            $reportes=DB::table('reportes')
            ->join('e_staff','e_staff.staff_id','=','reportes.id_usuario')
            ->select('reportes.id_reporte', 'e_staff.staff_nombre','e_staff.staff_sda','reportes.tipo_equipo','reportes.fecha_repor','reportes.id_staff_ati','reportes.serv_con')
            ->where('serv_con','<>','5');
            $reportes=$reportes->orderByDesc('reportes.id_reporte')
            ->get();
            $cont=0;
            $equipos = config('equipo');
            $edo_reporte=config('servicio');
                foreach ($reportes as $repo){
                    $tec=null;
                    if($repo->id_staff_ati <> null){
                        $tec_asig=Staff::select('staff_nombre')->where('staff_id',$repo->id_staff_ati)->get()->toArray();
                        $tec=(!isset($tec_asig['0']['staff_nombre'])) ? '' : utf8_encode($tec_asig['0']['staff_nombre']);
                    }
                    $rep_final[$cont]['id_reporte']=$repo->id_reporte;
                    $fecha=Carbon::parse($repo->fecha_repor);
                    $repo->fecha_repor=$fecha->format('d/m/Y H:i');
                    $rep_final[$cont]['area_dpto']=$repo->staff_sda;
                    $rep_final[$cont]['us_equipo']=$repo->staff_nombre;
                    $rep_final[$cont]['equ_prob']=$equipos[$repo->tipo_equipo];
                    $rep_final[$cont]['fecha_repo']=$repo->fecha_repor;
                    $rep_final[$cont]['tecnico']=$tec;
                    $rep_final[$cont]['edo_repo']=$edo_reporte[$repo->serv_con];
                    $cont++;
                }
        return view('administracion.admin', compact('usuario','rep_final'));
    }

    public function consulta(Request $request, $id, $tipo=null){
        $datos=$this->datos_detalle($id);
        $usuarios=session('usuario');
        $usuario=[];
        $usuario=$usuarios;
        $usuario['id_staff_ati']=$datos['reporte']['id_staff_ati'];
        $user_db_nom=utf8_encode($usuarios['staff_nombre']);
        if(!empty($datos)){
            $reporte=$datos['reporte'];
            $us_rep=$datos['us_rep'];
            $us_equ=$datos['us_equ'];
            $equ=$datos['equ'];
            $fecha=$datos['fecha'];
            if($tipo != 'imprimir'){
                return view('administracion.detalle', compact('reporte','us_rep','us_equ','equ','fecha','user_db_nom','usuario'));
            }else{
                $pdf = PDF::loadView('administracion.imprime', compact('reporte','us_rep','us_equ','equ','fecha','tipo','user_db_nom'))
                ->setOptions(['isRemoteEnabled' => true, 'defaultFont' => 'sans-serif', 'defaultMediaType' => 'print', 'chroot' => public_path()]);
                return ($pdf->stream());
            }
        }else{
            return redirect()->to('./admin');
        }
    }

    protected function datos_detalle($id){
        $datos=[];
        $edo_reporte=config('servicio');
       $reporte = Reporte::find($id);
        if(!empty($reporte)){
            $reporte['edo_reporte']=$edo_reporte[$reporte['serv_con']];
            $reporte['id_edo_reporte']=$reporte['serv_con'];
            $reporte['des_proble']= utf8_encode($reporte['des_proble']);
            $reporte['des_sol']=utf8_encode($reporte['des_sol']);
            $reporte['des_tra']=utf8_encode($reporte['des_tra']);
            $reporte['tec_asig']='No asignado';
            $datos['us_rep']=Staff::select('staff_nombre', 'staff_sda')->where('staff_id',$reporte['id_staff'])->get();
            $datos['us_equ']=Staff::select('staff_nombre')->where('staff_id',$reporte['id_usuario'])->get();
            $tec_asig=Staff::select('staff_nombre')->where('staff_id',$reporte['id_staff_ati'])->get()->toArray();
            if(isset($tec_asig[0]['staff_nombre'])){
                $reporte['tec_asig']=utf8_encode($tec_asig[0]['staff_nombre']);
                $reporte['id_tec_asig']=$reporte['id_staff_ati'];
            }
            $equipos = config('equipo');
            $datos['equ']=$equipos[$reporte['tipo_equipo']];
            $datos['fecha']=Carbon::createFromFormat('Y-m-d H:i:s', $reporte['fecha_repor'])->format('d/m/Y H:i');
            $datos['reporte']=$reporte;
        }
        return($datos);

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
            $datos_rep->id_staff_ati=null;
            $datos_rep->des_tra=utf8_decode(trim($request['des_tra']));
            $datos_rep->marca=utf8_decode(trim($request['marca']));
            $datos_rep->modelo=utf8_decode(trim($request['modelo']));
            $datos_rep->no_inve=utf8_decode(trim($request['no_inve']));
            $datos_rep->no_serie=utf8_decode(trim($request['no_serie']));
            $datos_rep->des_sol=utf8_decode(trim($request['des_sol']));
            $datos_rep->serv_con=$request['serv_con'];
            $datos_rep->fecha_inicio = ($datos_rep->fecha_inicio) ?? Carbon::now();
            $datos_rep->id_staff_ati=$request['tec_asig'];
            if($datos_rep->serv_con == 5){
                $datos_rep->fecha_ter = Carbon::now();
            }
            if($datos_rep->save()){
                if($datos_rep->serv_con != 5){
                    return redirect()-> route('admin-consulta',['id'=>$request['id'],'ref'=>'rep_vista'])->with('success','Su reporte ha sido actualizado.');
                }else{
                    return redirect()-> route('admin-reporte')->with('success','Su reporte ha sido actualizado.');
                }
            }

        }
        $datos=$this->datos_detalle($id);
        $user_log=session('usuario');
        $user_db_nom=utf8_encode($user_log['staff_nombre']);
        $asig_tecnico=Staff::select('staff_id','staff_nombre')->whereRaw("substring(staff_atrib,1,1) >= '3'")->get()->toArray();
        if(!empty($datos)){
            $reporte=$datos['reporte'];
            $us_rep=$datos['us_rep'];
            $us_equ=$datos['us_equ'];
            $equ=$datos['equ'];
            $fecha=$datos['fecha'];
            $edo_reporte=config('servicio');
            return view('administracion.actualiza', compact('reporte','us_rep','us_equ','equ','fecha','user_db_nom','asig_tecnico','edo_reporte'));
        }else{
            return redirect()->to('./admin');

        }

    }

    public function correo(){
        return view('emails.correo');
    }
}
