<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';
    public $timestamps = false;
    protected $fillable = ['nombre','apellidos','user','pass','correo','dni','tipo','domicilio','tarjeta','telefono'];
}
