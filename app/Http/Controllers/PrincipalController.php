<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PrincipalController extends Controller
{
    public function index ()
    {
        return view('login');
    }

    public function ingresar(Request $request){

        $request->validate([
            'user' => 'required|max:8',
            'password' => 'required|max:8',
        ]);
        $data=$request->all();
        $user=Staff ::  where ('staff_login', $data['user'])->where('staff_pass','like',$data['password'])->first();
        if(!empty($user)){
            $request->session()->put('usuario',$user->toArray());
            return redirect()->to("inicio");
        }else{
            throw ValidationException::withMessages(['password' => 'Datos inválidos']);
        }

    }


    public function logout(Request $request){
        $request->session()->forget('usuario');
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->to("/");
    }

    public function inicio(Request $request){
        $usuarios = $request->session()->get('usuario');
                $usuario=[];
                $usuario=$usuarios;
                $usuario['staff_nombre']=utf8_encode($usuarios['staff_nombre']);
               return view('inicio',compact('usuario'));
    }


}
