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
                    <div class="col-7 ml-2">
                        <h4>¿Estás seguro de que quieres eliminar la siguiente cuenta?</h4>
                        <form method="POST" action="{{ route('eliminarUsuario') }}">
                        @csrf
                        @foreach($usuario as $campo)
                        <input type="hidden" name="idusuario" value="{{session('usuarioid')}}">
                        <p>Nombre: {{$campo->nombre}}
                                &nbsp&nbsp&nbsp&nbsp&nbsp
                                Apellidos: {{$campo->apellidos}}
                                &nbsp&nbsp&nbsp&nbsp&nbsp
                                DNI: {{$campo->dni}}</p>
                            <p>Usuario: {{$campo->user}}
                                &nbsp&nbsp&nbsp&nbsp&nbsp
                                Tipo: {{$campo->tipo}}
                                &nbsp&nbsp&nbsp&nbsp&nbsp
                                Correo: {{$campo->correo}}</p>
                            <p>Teléfono: {{$campo->telefono}}
                                &nbsp&nbsp&nbsp&nbsp&nbsp
                                Tarjeta: {{$campo->tarjeta}}</p>
                                <p>Domicilio: {{$campo->domicilio}}  </p>
                        @endforeach
                        <a class="btn btn-secondary" href="{{route('inicio')}}">Cancelar</a>
                        <input type="submit" class="btn btn-danger" value="Eliminar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection