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