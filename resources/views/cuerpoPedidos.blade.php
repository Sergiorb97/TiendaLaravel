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
                <div class="col-9 ml-1">
                    <?php $cont = 0 ?>
                    @foreach($facturas as $factura)

                    <?php $fact = $factura->factura_id ?>

                    @if($cont != $fact)
                    <?php $cont = $factura->factura_id ?>
                    <table class="table table-hover mb-1">
                        <thead class="thead-dark">
                            <tr>
                                <th class="pl-2 text-center align-middle">Nº pedido</th>
                                <th></th>
                                <th class="pl-2 text-center align-middle">Producto</th>
                                <th class="pl-2 text-center align-middle">Estado</th>
                                <th class="pl-2 text-center align-middle">Fecha pedido</th>
                                <th class="pl-2 text-center align-middle">Fecha entrega</th>
                                <th class="pl-2 text-center align-middle">Unidades</th>
                                <th class="pl-2 text-center align-middle">Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @endif
                            <tr>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->factura_id}}
                                </td>
                                <td>
                                    <img class="w-0 h-25" style="max-width:80px;max-height:80px;" src="{{ asset('Assets/img/'.$factura->imagen) }}">
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->nombre}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->estado}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->fechapedido}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->fechaentrega}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->cantidad}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$factura->precio}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    <a href="{{ route('descargarPDF',$factura->factura_id) }}">
                                        <i style="color:red;" class="far fa-file-pdf fa-2x"></i>
                                    </a>
                                </td>
                                @if($factura->estado == 'En preparación')
                                <td name="borrar" class="p-2 text-center align-middle">
                                    <a id='{{$factura->factura_id}}' name='{{$factura->item_id}}' class="btn close" style="cursor:pointer;" aria-label="Close" data-toggle="modal" data-target="#confirmar">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @if($cont != $fact)
                        </tbody>
                    </table>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Cancelar pedido
            </div>
            <div class="modal-body">
                <div>
                    <h5>¿Qué desea realizar?</h5>
                    <div class="row mt-3">
                        <div class="col">
                            <a class="btn btn-primary" href="#" data-dismiss="modal">Volver</a>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{ route('cancelarItem') }}">
                                @csrf
                                <input type="hidden" value="" name="facturaid" id="facturaItem">
                                <input type="hidden" value="" name="itemid" id="item">
                                <input type="submit" style="color:white;cursor:pointer;" class="btn btn-warning" value="Cancelar este artículo">
                            </form>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{ route('cancelarPedido') }}">
                                @csrf
                                <input type="hidden" value="" name="facturaid" id="factura">
                                <input type="submit" style="color:white;cursor:pointer;" class="btn btn-danger" value="Quiero cancelar todo el pedido">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Para borrar pedido -->
<script>
    var facturaid = 0;
    $('[name=borrar] a').click(function() {
        $('#factura').val($(this).attr('id'));
        $('#facturaItem').val($(this).attr('id'));
        $('#item').val($(this).attr('name'));
    });
</script>
@endsection