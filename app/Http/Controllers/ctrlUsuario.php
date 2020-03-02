<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Illuminate\Support\Facades\Hash;

class ctrlUsuario extends Controller
{
    public function modificar(Request $request){
        Usuarios::where('usuario_id',$request->get('idusuario'))->update([
                'user' => $request->get('usuario'),
                'nombre' => $request->get('nombre'),
                'apellidos' => $request->get('apellidos'),
                'correo' => $request->get('correo'),
                'dni' => $request->get('dni'),
                'telefono' => $request->get('telefono'),
                'tarjeta' => $request->get('tarjeta'),
                'tipo' => $request->get('tipo'),
                'domicilio' => $request->get('domicilio')
        ]);
        return redirect()->route('inicio');
    }

    public function cambiarPass(Request $request){
        if($request->get('pass') == $request->get('passConfirm')){
            $contra = Hash::make($request->get('pass'));
            Usuarios::where('usuario_id',$request->get('idusuario'))->update(['pass' => $contra]);
            return redirect()->route('inicio');
        }else{
            return back();
        }
    }

    public function contraOlvidada(Request $request){
        $usuario = Usuarios::where('user',$request->get('userRestablecer'))->first();
        ctrlCorreo::correoCustom(
            $usuario->correo,
            'Confirmación para restablecer contraseña',
            '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
            </head>
            <body>
            <div style="background-color:grey;">
                <div style="background-color:white;">
                    <h5>Confirmacion de contraseña</h5>
                    <p>Hola '.$usuario->nombre.'  '.$usuario->apellidos.',</p>
                    <p>A continuacion te facilitamos el enlace a través del cual se modificará tu contraseña.</p>
                    <p>Una vez hagas click en el siguiente enlace tu contraseña será modificada automáticamente y te la mostraremos.</p>
                    <p>Porfavor modifica tu contraseña una vez hayas entrado de nuevo en tu cuenta.</p>
                    <a href="'.route('restablecerContra',$usuario->usuario_id).'">Restablecer</a>
                </div>
            </div>
            </body>');
            return redirect()->route('inicio');
    }

    public function restablecer($usuario_id){
        $contra = rand(999,9999);
        $encriptada = Hash::make($contra);
        Usuarios::where('usuario_id',$usuario_id)->update(['pass' => $encriptada]);
        return view('mostrarNuevaContra',['contra' => $contra]);
    }

    public function eliminar(){
        Usuarios::where('usuario_id',session('usuarioid'))->delete();
        session()->flush();
        return redirect()->route('inicio');
    }
}
