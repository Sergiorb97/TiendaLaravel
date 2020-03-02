<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table = 'facturas';
    public $timestamps = false;
    protected $primaryKey = 'factura_id';
    protected $fillable = [
        'estado',
        'nombre',
        'apellidos',
        'dni',
        'domicilio',
        'correo',
        'tarjeta',
        'fechapedido',
        'usuario_id'
    ];

}
