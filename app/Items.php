<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    public $timestamps = false;
    protected $primaryKey = 'item_id';
    protected $fillable = [
        'precio',
        'cantidad',
        'factura_id',
        'producto_id'
    ];
}
