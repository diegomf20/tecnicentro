<?php

namespace App\Http\Controllers;

use App\Model\DetalleDiagnostico;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Reparacion;
use App\Model\ReparacionHerramienta;
use App\Model\Diagnostico;

class ReparacionController extends Controller
{
    public function index(Request $request){
        if ($request->data=="Finalizado") {
            $Reparaciones=Reparacion::with('cliente')
                ->whereIn('estado',['4'])
                ->get();
        }else{
            $Reparaciones=Reparacion::with('cliente')
                ->whereNotIn('estado',['4'])
                ->get();
        }
        return response()->json($Reparaciones);
    }
    public function show($id){

        $Reparacion=Reparacion::with('cliente')
                ->with('detalles')
                ->where('id',$id)->first();
        return response()->json([
            "reparacion"    =>  $Reparacion,
        ]);

        // return response()->json($Reparacion);
    }
    public function show2($id){
        $rh=ReparacionHerramienta::with('herramienta')->with('detalles')
            ->where('id',$id)->first();
        return response()->json($rh);
    }

    public function nota(Request $request){
        $siguiente=Reparacion::select(DB::raw('count(id)+1 as siguiente'))
                ->first()->siguiente;
        $Reparacion=new Reparacion();
        $Reparacion->codigo=str_pad($siguiente,8, "0", STR_PAD_LEFT);
        $Reparacion->cliente_id=$request->cliente_id;
        $Reparacion->save();
        foreach ($request->detalles as $key => $item) {
            $reparacionHerramienta=new ReparacionHerramienta();
            $reparacionHerramienta->serie=$item['serie'];
            $reparacionHerramienta->herramienta_id=$item['herramienta_id'];
            $reparacionHerramienta->reparacion_id=$Reparacion->id;
            $reparacionHerramienta->estado="0";
            $reparacionHerramienta->save();
        }
        return response()->json([
            "status" => "OK",
            "data"  => $Reparacion
        ]);
    }

    public function diagnosticar(Request $request,$id){
        
        $Reparacion=Reparacion::where('id',$id)->first();
        $Reparacion->estado='1';
        $Reparacion->save();
        $diagnostico=new Diagnostico();
        $diagnostico->reparacion_id=$id;
        $diagnostico->dias=$request->dias;
        $diagnostico->costo=$request->costo;
        $diagnostico->descripcion=$request->descripcion;
        $diagnostico->save();

        /**
         * detalle compra
         */
        foreach ($request->items as $key => $item) {
            $detalleDiagnostico=new DetalleDiagnostico();
            $detalleDiagnostico->cantidad=$item['cantidad'];
            $detalleDiagnostico->pieza_id=$item['pieza_id'];
            $detalleDiagnostico->diagnostico_id=$diagnostico->id;
            $detalleDiagnostico->save();
        }

        return response()->json([
            "status" => "OK",
            "data"  => $diagnostico
        ]);
    }
    public function aprobar($id){
        $Reparacion=Reparacion::where('id',$id)->first();
        $Reparacion->estado='2';
        $Reparacion->save();
        return response()->json([
            "status" => "OK",
        ]);
    }
    public function reparar($id){
        $Reparacion=Reparacion::where('id',$id)->first();
        $Reparacion->estado='3';
        $Reparacion->save();
        return response()->json([
            "status" => "OK",
        ]);
    }
    public function cobrar($id){
        $Reparacion=Reparacion::where('id',$id)->first();
        $Reparacion->estado='4';
        $Reparacion->save();
        return response()->json([
            "status" => "OK",
        ]);
    }
}
