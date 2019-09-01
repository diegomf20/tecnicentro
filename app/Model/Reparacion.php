<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    protected $table="reparacion";
    public function cliente()
    {
        return $this->belongsTo('App\Model\Cliente');
    }
    public function herramienta()
    {
        return $this->belongsTo('App\Model\Herramienta');
    }    
    public function diagnostico()
    {
        return $this->hasOne('App\Model\Diagnostico');
    }    
    public function detalles()
    {
        return $this->hasMany('App\Model\ReparacionHerramienta')->with('herramienta');
    }
}
