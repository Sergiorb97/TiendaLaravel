<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <script src="{{ asset('Assets/js/JQUERY.js') }}"></script>
  <script src="{{ asset('Assets/js/bootstrap.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('Assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('Assets/css/botonhamburguesa.css') }}">
</head>

<body>
    <div class="text-center m-2">
        <h2>Factura simplificada Nº {{$id}} </h2>
    </div>
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
            @foreach($articulosCarrito as $producto)
            <tr class="">
                <td class="p-2 text-center align-middle">
                    <img class="w-0 h-0 mt-2" style="max-width:120px;max-height:120px;" src="{{ asset('Assets/img/'.$producto->attributes->imagen) }}">
                </td>
                <td class="p-2 text-center align-middle">
                    {{$producto->name}}
                </td>
                <td class="p-2 text-center align-middle">
                    {{$producto->attributes->descripcion}}
                </td>
                <td class="p-2 text-center align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <span class="btn btn-light border">{{$producto->quantity}}</span>
                    </div>
                </td>
                <td class="p-2 text-center align-middle">
                    {{($producto->price)*($producto->quantity)}}€
                </td>
            </tr>
            @endforeach
            <tr class="bg-light">
                <td class="p-2 text-center align-middle"></td>
                <td class="p-2 text-center align-middle"></td>
                <td class="p-2 text-center align-middle"></td>
                <th class="p-2 text-center align-middle">Subtotal</th>
                <th class="p-2 text-center align-middle">{{Cart::getTotal()}}€</th>
            </tr>
        </tbody>
    </table>
</body>