<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inicio</title>
  <script src="{{ asset('Assets/js/JQUERY.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="{{ asset('Assets/js/bootstrap.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('Assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('Assets/css/botonhamburguesa.css') }}">
  <script src="https://kit.fontawesome.com/0f0997db76.js"></script>
</head>

<body>
  <header>
    @csrf
    <div class="container-fluid fixed-top bg-dark py-3">
      <h2><a id="inicio" href="{{ route('inicio') }}" role="button" style="z-index:1500;text-decoration: none;" class="float-left position-absolute ml-5">InfoZone</a></h2>
      <div class="row">
        <div class="col-sm-2 show sidebar">
          <!-- spacer col -->
        </div>
        <div class="col px-3">
          <!-- toggler -->
          <a id="hamburguer" class="ml-4n" href="#" role="button btn-link">
            <i class="fa fa-bars fa-lg fa-2x"></i>
          </a>
          <div class="float-right">
            @if(session()->has('user'))
            <span class="text-white float-left mr-5 mt-2">Bienvenido {{session('nombre')}}</span>
            <div class="dropdown float-left mr-5 pr-5">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Perfil
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('datosCuenta', session('usuarioid')) }}">Mi cuenta</a>
                <a class="dropdown-item" href="{{ route('datosPedidos', session('usuarioid')) }}">Mis pedidos</a>
                <a class="dropdown-item" href="{{route('cerrarSesion')}}">Cerrar sesión</a>
              </div>
            </div>
            @else
            <a type="button" href="" class="mr-5" data-toggle="modal" data-target="#login">
              <i class="fas fa-user fa-2x"></i>
            </a>
            @endif
            <a id="shopping-cart" href="{{ route('verCarrito') }}" class="mr-4" role="button">
              <i class="fas fa-shopping-cart fa-2x">
              </i>
            </a>
            <div style="right:43px;top:-15px;" class="position-absolute">
              <span class="badge badge-pill badge-light">{{ Cart::getTotalQuantity() }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  @if(session('success'))
  <div style="z-index:1500;right:5%;bottom:5%;" class="position-fixed alert alert-success">
    <button type="button" style="top:5%;right:5%;" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    <h4 class="alert-heading">¡Bien hecho!</h4>
    <span>
      {{ session('success') }}&nbsp&nbsp&nbsp&nbsp&nbsp
    </span>
  </div>
  @endif
  @if(session('fail'))
  <div style="z-index:1500;right:5%;bottom:5%;" class="position-fixed alert alert-danger">
    <button type="button" style="top:5%;right:5%;" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">¡Vaya, ha ocurrido un error!</h4>
    <span>
      {{ session('fail') }}&nbsp&nbsp&nbsp&nbsp&nbsp
    </span>
  </div>
  @endif


  @if($errors->has('usuarioLogin') || $errors->has('passLogin'))
  <script>
    $(window).on('load', function() {
      $('#login').modal('show');
    });
  </script>
  @endif
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Inicio de sesión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Login -->
          <div id="login" style="display:block">
            <form method="POST" action="{{ route('login') }}" class="form-signin">
              @csrf
              <div class="text-center">
                <input type="text" name="usuarioLogin" class="form-control my-3" placeholder="Usuario *" value="{{ old('usuarioLogin') }}">
                @if($errors->has('usuarioLogin'))
                <div class="alert alert-danger">{{ $errors->first('usuarioLogin') }}</div>
                @endif
                <input type="password" name="passLogin" class="form-control my-3" placeholder="Contraseña *" value="{{ old('passLogin') }}">
                @if($errors->has('passLogin'))
                <div class="alert alert-danger">{{ $errors->first('passLogin') }}</div>
                @endif
                @if(session('mensajeIncorrecto'))
                <div class="alert alert-danger">{{session('mensajeIncorrecto')}}</div>
                @endif
                @if(session('mensajeCorrecto'))
                <div class="alert alert-success">{{session('mensajeCorrecto')}}</div>
                @endif
                <button type="submit" class="btn btn-primary btn-block my-2">Entrar</button>
              </div>
            </form>
            <span id="noRegistro" class="btn-link float-left" data-dismiss="modal" style="cursor:pointer" data-toggle="modal" data-target="#registro">No estoy registrado</span>
            <span id="olvidada" class="btn-link float-right" data-dismiss="modal" style="cursor:pointer" data-toggle="modal" data-target="#contraOlvidada">He olvidado mi contraseña</span>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Confirmar</button> -->
        </div>
      </div>
    </div>
  </div>



  @if($errors->has('nombre') || $errors->has('apellidos') || $errors->has('usuarioRegistro') || $errors->has('passRegistro') || $errors->has('dni') || $errors->has('correo') || session('existe') || $errors->has('tarjeta'))
  <script>
    $(window).on('load', function() {
      $('#registro').modal('show');
    });
  </script>
  @endif
  <div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="registro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registro">Registro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Registro -->
          <div id="registro">
            <form method="POST" action="{{ route('registro') }}">
              @csrf
              <div class="container-fluid">
                <div class="row mb-3">
                  <div clas="col">
                    <input type="text" name="nombre" class="form-control ml-2" placeholder="Nombre*" value="{{ old('nombre') }}">
                    @if($errors->has('nombre'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('nombre') }}</div>
                    @endif
                  </div>
                  <div clas="col">
                    <input type="text" name="apellidos" class="form-control ml-3" placeholder="Apellidos*" value="{{ old('apellidos') }}">
                    @if($errors->has('apellidos'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('apellidos') }}</div>
                    @endif
                  </div>
                  <div clas="col">
                    <input type="text" name="dni" class="form-control ml-4" placeholder="DNI/CIF*" value="{{ old('dni') }}">
                    @if($errors->has('dni'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('dni') }}</div>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <div clas="col">
                    <input type="text" name="usuarioRegistro" class="form-control ml-2" placeholder="Usuario*" value="{{ old('usuarioRegistro') }}">
                    @if($errors->has('usuarioRegistro'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('usuarioRegistro') }}</div>
                    @endif
                    @if(session('existe'))
                    <div class="alert alert-danger ml-2 my-1">{{ session('existe') }}</div>
                    @endif
                  </div>
                  <div clas="col">
                    <input type="password" name="passRegistro" class="form-control ml-3" placeholder="Contraseña*">
                    @if($errors->has('passRegistro'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('passRegistro') }}</div>
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <div clas="col">
                    <input type="text" name="tarjeta" class="form-control ml-2" placeholder="Tarjeta*" value="{{ old('tarjeta') }}">
                    @if($errors->has('tarjeta'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('tarjeta') }}</div>
                    @endif
                  </div>
                  <div clas="col">
                    <input type="text" name="telefono" class="form-control ml-3" placeholder="Teléfono" value="{{ old('telefono') }}">
                  </div>
                </div>

                <div class="row mb-3">
                  <div clas="col">
                    <input type="text" name="domicilio" class="form-control ml-2" placeholder="Domicilio" value="{{ old('domicilio') }}">
                  </div>
                  <div clas="col">
                    <input type="text" name="correo" class="form-control ml-3" placeholder="Correo*" value="{{ old('correo') }}">
                    @if($errors->has('correo'))
                    <div class="alert alert-danger ml-2 my-1">{{ $errors->first('correo') }}</div>
                    @endif
                  </div>
                  <div clas="col">
                    <select name="tipo" class="form-control ml-4" value="{{ old('tipo') }}">
                      <option>Particular</option>
                      <option>Empresa</option>
                      <option>Autónomo</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block mx-5 mt-3">Crear cuenta</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Confirmar</button> -->
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="contraOlvidada" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          Contraseña olvidada
        </div>
        <div class="modal-body">
          <div>
            <h5>Inserta tu nombre de usuario, te enviaremos un correo de confirmación al correo asociado a ese usuario.</h5>
            <div class="row mt-3">
              <div class="col">
                <form method="POST" action="{{ route('olvidada') }}">
                  @csrf
                  <p class="text-center"><input type="text" name="userRestablecer" placeholder="Usuario"></p>
                  <a class="btn btn-secondary ml-5" href="#" data-dismiss="modal">Volver</a>
                  <input type="submit" style="color:white;cursor:pointer;" class="btn btn-success float-right mr-5" value="Aceptar">
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