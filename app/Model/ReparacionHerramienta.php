<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReparacionHerramienta extends Model
{
    protected $table="reparacion_herramienta";
    public $timestamps = false;
    public function herramienta()
    {
        return $this->belongsTo('App\Model\Herramienta');
    }
    public function detalles()
    {
        return $this->hasMany('App\Model\DiagnosticoAccesorio')->with('accesorio');
    }
}
