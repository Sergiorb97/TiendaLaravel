<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Illuminate\Support\Facades\Hash;

class ctrlUsuario extends Controller
{
    public function modificar(Request $request){

        $this->validate($request, [
            'usuarioMod' => 'required|alpha_num',
            'nombreMod' => 'required|alpha',
            'apellidosMod' => 'required|alpha',
            'correoMod' => 'required|email',
            'dniMod' => 'required|alpha_num',
            'tarjetaMod' => 'required|numeric'
        ]);
        
        if($request->get('usuarioMod') != session('user')){
            $countUsers = Usuarios::where('user',$request->get('usuarioMod'))->count();
            if($countUsers != 0){
                return back()->with('existeMod','Este nombre de usuario ya existe');
            }
        }

        Usuarios::where('usuario_id',$request->get('idusuario'))->update([
                'user' => $request->get('usuarioMod'),
                'nombre' => $request->get('nombreMod'),
                'apellidos' => $request->get('apellidosMod'),
                'correo' => $request->get('correoMod'),
                'dni' => $request->get('dniMod'),
                'telefono' => $request->get('telefonoMod'),
                'tarjeta' => $request->get('tarjetaMod'),
                'tipo' => $request->get('tipoMod'),
                'domicilio' => $request->get('domicilioMod')
        ]);

        session(['usuarioid' => $request->get('idusuario')]);
        session(['user' => $request->get('usuarioMod')]);
        session(['nombre' => $request->get('nombreMod')]);
        session(['apellidos' => $request->get('apellidosMod')]);
        session(['dni' => $request->get('dniMod')]);
        session(['domicilio' => $request->get('domicilioMod')]);
        session(['correo' => $request->get('correoMod')]);
        session(['telefono' => $request->get('telefonoMod')]);
        session(['tarjeta' => $request->get('tarjetaMod')]);

        return redirect()->route('inicio')->with('success','¡Datos de usuario modificados correctamente!');
    }

    public function cambiarPass(Request $request){
        if($request->get('pass') == $request->get('passConfirm')){
            $contra = Hash::make($request->get('pass'));
            Usuarios::where('usuario_id',$request->get('idusuario'))->update(['pass' => $contra]);
            return redirect()->route('inicio')->with('success','¡Contraseña cambiada con exito!');
        }else{
            return back()->with('fail','Ha surgido un error, asegurate de insertar las contraseñas correctamente');
        }
    }

    public function contraOlvidada(Request $request){
        $usuario = Usuarios::where('user',$request->get('userRestablecer'))->first();
        if(!empty($usuario)){
            dd($usuario);
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
                return redirect()->route('inicio')->with('success','¡Se ha enviado un correo para que modifiques tu contraseña!');
        }else{
            return redirect()->route('inicio')->with('fail','¡Este nombre de usuario no existe!');
        }
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
        return redirect()->route('inicio')->with('success','¡Se ha eliminado el usuario con exito!');
    }
}
