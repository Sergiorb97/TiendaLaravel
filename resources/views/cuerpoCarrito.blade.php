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
            <div class="col-12 text-center mb-5 mt-5">
                <h2>Carrito de la compra</h2>
            </div>
            @if(Cart::isEmpty() == 0)
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th></th>
                        <th class="pl-2 text-center align-middle">Nombre</th>
                        <th class="pl-2 text-center align-middle">Descripción</th>
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
                            {{$producto->attributes->descripcion}}
                        </td>
                        <td class="p-2 text-center align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('modificarCantidad',[$producto-> id,-1]) }}" class="btn border">-</a>
                                <span class="btn btn-light border">{{$producto->quantity}}</span>
                                <a href="{{ route('modificarCantidad',[$producto-> id,1]) }}" class="btn border">+</a>
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
                        <td class="p-2 text-center align-middle"></td>
                        <th class="p-2 text-center align-middle">Subtotal</th>
                        <th class="p-2 text-center align-middle">{{Cart::getTotal()}}€</th>
                        <td class="p-2 text-center align-middle"></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center mb-5">
                <a href="{{route('vaciarCarrito')}}" class="btn btn-light border mr-5"><i class="far fa-trash-alt"></i>&nbsp&nbspVaciar</a>
                <a href="{{route('comprobarCompra')}}" class="btn btn-success border ml-5">Realizar compra</a>
            @else
            <div class="text-center mb-5">
                <p>En estos momentos tu carrito está vacío.</p>
            @endif
                <a href="./" class="btn btn-light border ml-4">Seguir comprando</a>
            </div>
        </div>
    </div>
</div>
@endsection