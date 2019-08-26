<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetalleDiagnostico extends Model
{
    protected $table="diagnóstico_pieza";
    public $timestamps = false;

    public function pieza()
    {
        return $this->belongsTo('App\Model\Pieza');
    } 
}
