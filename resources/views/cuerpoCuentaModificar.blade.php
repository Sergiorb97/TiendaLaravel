@extends ('layout')
@section ('cuerpo')
<div class="container-fluid">
    <div class="row vh-100 flex-nowrap">
        <div name="inicio" id="oculto" class="col-2 show sidebar text-white px-0">
            <ul class="col-2 nav flex-column flex-nowrap text-truncate navbar-dark bg-dark position-fixed pt-2 vh-100" id="sidebar">
                <li class="nav-item">
                    <h2 class="col-2 mt-5 pt-5">Categorías</h2>
                    @foreach($categorias as $categoria)
                    <a class="nav-link" href="{{ route('opcCategoria',$categoria -> categoria_id) }}">{{$categoria -> nombre}}</a>
                    @endforeach
                </li>
            </ul>
        </div>
        <div name="datos" id="izq" class="col-9 py-3 mt-5 pt-5">
            <!-- Pagina central -->
            <div>
                <!-- Anuncios -->
            </div>
            <div class="row bg-light p-4">
                <div class="col-12 text-center mb-2 mt-2">
                    <h2>Datos de cuenta</h2>
                </div>
                <div class="col-2 mt-4 mr-5 pr-2">
                    <div><h4>Mi cuenta</h4></div>
                    <div>
                        <ul>
                            <li><h6><a class="text-muted" style="text-decoration: none;" href="{{route('datosCuenta',session('usuarioid'))}}">Mis datos</a></h6></li>
                            <li><h6><a class="text-muted" style="text-decoration: none;" href="{{route('datosCuentaModificar',session('usuarioid'))}}">Modificar datos</a></h6></li>
                            <li><h6><a class="text-muted" style="text-decoration: none;" href="{{route('datosCuentaCambiarPass',session('usuarioid'))}}">Cambiar contraseña</a></h6></li>
                            <li><h6><a class="text-muted" style="text-decoration: none;" href="{{route('datosCuentaEliminar',session('usuarioid'))}}">Eliminar cuenta</a></h6></li>
                        </ul>
                    </div>
                    <div><h4>Pedidos</h4></div>
                    <div>
                        <ul>
                            <li><h6><a class="text-muted" style="text-decoration: none;" href="{{ route('datosPedidos', session('usuarioid')) }}">Ver todos mis pedidos</a></h6></li>
                        </ul>
                    </div>
                </div>
                <div class="col-7 mt-4 ml-2">
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
                            Correo: <input type="text" name="correoMod" style="width:175px;" value="{{$campo->correo}}"></p>
                        <p>Teléfono: <input type="text" name="telefonoMod" style="width:125px;" value="{{$campo->telefono}}">
                            &nbsp&nbsp&nbsp
                            Tarjeta: <input type="text" name="tarjetaMod" style="width:125px;" value="{{$campo->tarjeta}}"></p>
                        <p>Domicilio:</p>
                        <p><textarea name="domicilioMod" style="width:400px;">{{$campo->domicilio}}</textarea></p>
                        @endforeach
                        <input type="submit" class="btn btn-success" value="Guardar cambios">
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