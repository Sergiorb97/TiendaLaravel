@extends ('layout')
@section ('cuerpo')
<div class="container-fluid">
    <div class="row vh-100 flex-nowrap">
        <div name="inicio" id="oculto" class="col-2 show sidebar text-white px-0">
            <ul class="col-2 nav flex-column flex-nowrap text-truncate navbar-dark bg-dark position-fixed pt-2 vh-100" id="sidebar">
                <li class="nav-item">
                    <h2 class="col-2 mt-5 pt-2">Categorías</h2>
                    @foreach($categorias as $categoria)
                    <a class="nav-link" href="{{ route('opcCategoria',$categoria -> categoria_id) }}">{{$categoria -> nombre}}</a>
                    @endforeach
                </li>
            </ul>
        </div>
        <div name="datos" id="izq" class="col-9 py-3 mt-5 pt-4">
            <!-- Pagina central -->
            <div>
                <!-- Anuncios -->
            </div>
            <div class="col-12 text-center mt-2 bg-secondary">
                <h2>Datos de cuenta</h2>
            </div>
            <div class="row">
                <div class="col-2 mr-1 bg-white">
                    <div class="bg-secondary">Mi cuenta</div>
                    <div class="text-muted">
                        <p><a class="text-muted" href="{{route('datosCuenta',session('usuarioid'))}}">Mis datos</a></p>
                        <p><a class="text-muted" href="{{route('datosCuentaModificar',session('usuarioid'))}}">Modificar datos</a></p>
                        <p><a class="text-muted" href="{{route('datosCuentaCambiarPass',session('usuarioid'))}}">Cambiar contraseña</a></p>
                        <p><a class="text-muted" href="{{route('datosCuentaEliminar',session('usuarioid'))}}">Eliminar cuenta</a></p>
                    </div>
                    <div class="bg-secondary">Pedidos</div>
                    <div>
                        <p><a class="text-muted" href="{{ route('datosPedidos', session('usuarioid')) }}">Ver todos mis pedidos</a></p>
                    </div>
                </div>
                <div class="col-7 ml-2">
                    <form method="POST" action="{{ route('modificarDatos') }}">
                        @csrf
                        @foreach($usuario as $campo)
                        <input type="hidden" name="idusuario" value="{{session('usuarioid')}}">
                        <p>Nombre: <input type="text" style="width:125px;" name="nombreMod" value="{{$campo->nombre}}">
                            &nbsp&nbsp&nbsp
                            Apellidos: <input type="text" name="apellidosMod" style="width:125px;" value="{{$campo->apellidos}}">
                            &nbsp&nbsp&nbsp
                            DNI: <input type="text" name="dniMod" style="width:125px;" value="{{$campo->dni}}"></p>
                        <p>Usuario: <input type="text" name="usuarioMod" style="width:125px;" value="{{$campo->user}}">
                            &nbsp&nbsp&nbsp
                            Tipo: <select name="tipoMod" value="{{$campo->tipo}}">
                                <option>Particular</option>
                                <option>Empresa</option>
                                <option>Autónomo</option>
                            </select>
                            &nbsp&nbsp&nbsp
                            Correo: <input type="text" name="correoMod" style="width:200px;" value="{{$campo->correo}}"></p>
                        <p>Teléfono: <input type="text" name="telefonoMod" style="width:125px;" value="{{$campo->telefono}}">
                            &nbsp&nbsp&nbsp
                            Tarjeta: <input type="text" name="tarjetaMod" style="width:125px;" value="{{$campo->tarjeta}}"></p>
                        <p>Domicilio:</p>
                        <p><textarea name="domicilioMod" style="width:400px;">{{$campo->domicilio}}</textarea></p>
                        @endforeach
                        <input type="submit" class="btn btn-secondary" value="Guardar cambios">
                    </form>
                    <!-- Errores -->
                    @if($errors->has('nombreMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('nombreMod') }}</div>
                    @endif
                    @if($errors->has('apellidosMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('apellidosMod') }}</div>
                    @endif
                    @if($errors->has('dniMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('dniMod') }}</div>
                    @endif
                    @if($errors->has('usuarioMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('usuarioMod') }}</div>
                    @endif
                    @if(session('existeMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ session('existeMod') }}</div>
                    @endif
                    @if($errors->has('tarjetaMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('tarjetaMod') }}</div>
                    @endif
                    @if($errors->has('correoMod'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('correoMod') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection