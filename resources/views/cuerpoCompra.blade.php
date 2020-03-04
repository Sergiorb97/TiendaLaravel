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
        <div name="datos" id="izq" class="col-9 py-3 mt-5 pt-4">
            <!-- Pagina central -->
            <div>
                <!-- Anuncios -->
            </div>
            <div class="col-12 text-center mb-5 mt-5">
                <h2>Detalles del pedido</h2>
            </div>
            @if(Cart::isEmpty() == 0)
            <div class="row">
                <div class="col-4">
                    <div class="bg-light p-4">
                        <h4>Datos de usuario</h4>
                        <ul>
                            <li>Usuario: {{session('user')}}</li>
                            <li>Dirección: {{session('direccion')}}</li>
                            <li>Correo: {{session('correo')}}</li>
                            <li>Teléfono: {{session('telefono')}}</li>
                            <li>Nº Tarjeta:
                                @if(!empty(session('tarjeta')))
                                {{session('tarjeta')}}
                                @else
                                <input type="text" name="numtarjeta" id="numtarjeta"> <button class="btn btn-success">Confirmar</button>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-8 text-center">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th></th>
                                <th class="pl-2 text-center align-middle">Nombre</th>
                                <th class="pl-2 text-center align-middle">Unidades</th>
                                <th class="pl-2 text-center align-middle">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carrito as $producto)
                            <tr class="">
                                <td class="p-2 text-center align-middle">
                                    <img class="w-0 h-25" src="{{ asset('Assets/img/'.$producto->attributes->imagen) }}">
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{$producto->name}}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <span class="btn btn-light border">{{$producto->quantity}}</span>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle">
                                    {{($producto->price)*($producto->quantity)}}€
                                </td>
                                <td class="p-2 text-center align-middle">
                                    <a href="{{ route('borrarProducto',$producto-> id) }}" class="btn close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-light">
                                <td class="p-2 text-center align-middle"></td>
                                <td class="p-2 text-center align-middle"></td>
                                <th class="p-2 text-center align-middle">Subtotal</th>
                                <th class="p-2 text-center align-middle">{{Cart::getTotal()}}€</th>
                                <td class="p-2 text-center align-middle"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="{{route('comprar')}}" class="btn btn-success border">Confirmar compra</a>
                    </div>
                </div>
            </div>
            <div class="text-center mb-5">

                @else
                <div class="text-center mb-5">
                    <p>En estos momentos tu carrito está vacío.</p>
                    <a href="{{route('comprar')}}" class="btn btn-light border ml-4">Seguir comprando</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection