<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Reparacion;

class ReparacionController extends Controller
{
    public function nota(Request $request){
        $Reparacion=new Reparacion();
        $Reparacion->cliente_id=$request->cliente_id;
        $Reparacion->herramienta_id=$request->herramienta_id;
        $Reparacion->modelo=$request->modelo;
        $Reparacion->serie=$request->serie;
        $Reparacion->save();
        return response()->json([
            "status" => "OK",
            "data"  => $Reparacion
        ]);
    }
}
