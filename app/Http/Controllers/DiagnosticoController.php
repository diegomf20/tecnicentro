<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Reparacion;
use App\Model\ReparacionHerramienta;
use App\Model\DiagnosticoAccesorio;

class DiagnosticoController extends Controller
{
    public function storage(Request $request,$herramienta_reparacion_id){
        foreach ($request->detalles as $key => $item) {
            $da=new DiagnosticoAccesorio();
            $da->cantidad=$item['cantidad'];
            $da->accesorio_id=$item['accesorio_id'];
            $da->reparacion_herramienta_id=$herramienta_reparacion_id;
            $da->save();
        }
        $detalle=ReparacionHerramienta::where('id',$herramienta_reparacion_id)
            ->first();
        $detalle->diagnostico=$request->diagnostico;
        $detalle->costo=$request->costo;
        $detalle->dias=$request->dias;
        $detalle->estado="1";
        $detalle->save();

        $encontrado=ReparacionHerramienta::where('reparacion_id',$detalle->reparacion_id)
            ->where('estado','0')
            ->first();
        if ($encontrado==null) {
            $Reparacion=Reparacion::where('id',$detalle->reparacion_id)
                ->first();
            $Reparacion->estado='1';
            $Reparacion->save();
            return response()->json([
                "status" => "OK",
                "data"  => "Se diagnóstico todas las Herramientas"
            ]);
        }
        return response()->json([
            "status" => "OK",
            "data"  => "Se diagnóstico la Herramienta."
        ]);
    }
}
