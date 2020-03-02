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
            <div class="col-12 text-center mb-5 mt-2">
                <h2>Productos destacados</h2>
            </div>
            <div class='card-deck col mx-auto'>
                @foreach($destacados as $destacado)
                <div class="row card text-center w-25 h-25">
                    <!--w-530 h-530 -->
                    <img class="card-img-top " src="Assets/img/{{$destacado -> imagen}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$destacado -> nombre}}</h5>
                        <p>{{$destacado -> descripcion}}</p>
                        <p>{{$destacado -> precioventa}}€</p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{ route('insertarCarrito',$destacado-> producto_id) }}"><i class="fas fa-cart-plus"></i></a>
                        <a class="btn btn-primary" href="{{ route('opcInfo',$destacado-> producto_id) }}"><i class="fas fa-info-circle"></i></a>
                    </div>
                </div>
                <!-- Muestra de productos DESTACADOS (general si no hay categoria y de esa categoria si se selecciona una)-->
                @endforeach
            </div>
            <div class="col-12 text-center mb-5 mt-5">
                <h2>Todos los productos</h2>
            </div>
            <div class='card-deck'>
                @foreach($productos as $producto)
                <div class="d-flex row flex-wrap mx-auto w-25 h-25">
                    <div class="row card text-center mb-3">
                        <!--w-530 h-530 -->
                        <img class="card-img-top img-fluid" src="Assets/img/{{$producto -> imagen}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$producto -> nombre}}</h5>
                            <p>{{$producto -> descripcion}}</p>
                            <p>{{$producto -> precioventa}}€</p>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary" href="{{ route('insertarCarrito',$producto-> producto_id) }}"><i class="fas fa-cart-plus"></i></a>
                            <a class="btn btn-primary" href="{{ route('opcInfo',$producto-> producto_id) }}"><i class="fas fa-info-circle"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Muestra de resto de productos-->
            </div>
            <div class="aling-self-center">
                {{ $productos->links() }}
                <!-- Paginacion -->
            </div>
        </div>
    </div>
</div>
@endsection