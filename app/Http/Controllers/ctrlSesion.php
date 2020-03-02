<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
use Illuminate\Support\Facades\Hash;

class ctrlSesion extends Controller
{
    public function comprobarLogin(Request $request)
    {
        $this->validate($request, [
            'usuarioLogin' => 'required',
            'passLogin' => 'required'
        ]);

        $datos = Usuarios::where('user', $request->usuarioLogin)->first();

        if (Usuarios::where('user', $request->usuarioLogin)->exists() && password_verify($request->passLogin, $datos->pass)) {

            //dd($datos);
                session(['usuarioid' => $datos->usuario_id]);
                session(['user' => $datos->user]);
                session(['nombre' => $datos->nombre]);
                session(['apellidos' => $datos->apellidos]);
                session(['dni' => $datos->dni]);
                session(['domicilio' => $datos->domicilio]);
                session(['correo' => $datos->correo]);
                session(['telefono' => $datos->telefono]);
                session(['tarjeta' => $datos->tarjeta]);
            
            return back()->with('mensajeCorrecto', 'Sesión iniciada correctamente');
        } else {
            return back()->with('mensajeIncorrecto', 'Credenciales incorrectas');
        }
    }

    public function comprobarRegistro(Request $request)
    {
        $this->validate($request, [
            'usuarioRegistro' => 'required',
            'passRegistro' => 'required',
            'nombre' => 'required|alpha',
            'apellidos' => 'required|alpha',
            'correo' => 'required',
            'dni' => 'required'
        ]);

        $contraseña = $request->get('passRegistro');
        $contraseña = Hash::make($contraseña);
        Usuarios::create([
            'nombre' => $request->get('nombre'),
            'apellidos' => $request->get('apellidos'),
            'user' => $request->get('usuarioRegistro'),
            'pass' => $contraseña,
            'correo' => $request->get('correo'),
            'dni' => $request->get('dni'),
            'tipo' => $request->get('tipo'),
            'domicilio' => $request->get('domicilio')
        ]);
        return back();
    }
}
