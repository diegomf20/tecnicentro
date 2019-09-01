<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DiagnosticoAccesorio extends Model
{
    protected $table="diagnostico_accesorio";
    public $timestamps = false;

    public function accesorio()
    {
        return $this->belongsTo('App\Model\Accesorio');
    } 
}
