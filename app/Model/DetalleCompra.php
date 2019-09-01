<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table="detallecompra";
    public $timestamps = false;

    public function accesorio()
    {
        return $this->belongsTo('App\Model\Accesorio');
    }
}
