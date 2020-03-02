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
            <div class="col-12 mb-5 mt-5">
                @foreach($producto as $atributo)
                <div class="row">
                    <img class="img-fluid" src="{{ asset('Assets/img/'.$atributo -> imagen) }}"></img>
                    <div class="col align-self-center">
                        <h2>{{$atributo -> nombre}} {{$atributo -> descripcion}}</h2>
                        <p>{{$atributo -> precioventa}}€</p>
                        <p><a class="btn btn-primary" href="{{ route('insertarCarrito',$atributo-> producto_id) }}"><i class="fas fa-cart-plus"></i></a></p>
                        <p>{{$atributo -> Info}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection