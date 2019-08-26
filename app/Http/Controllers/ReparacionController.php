<?php

namespace App\Http\Controllers;

use App\Model\DetalleDiagnostico;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Reparacion;
use App\Model\Diagnostico;

class ReparacionController extends Controller
{
    public function index(Request $request){
        if ($request->data=="Finalizado") {
            $Reparaciones=Reparacion::with('cliente')->with('herramienta')
                ->whereIn('estado',['4'])
                ->get();
        }else{
            $Reparaciones=Reparacion::with('cliente')->with('herramienta')
                ->whereNotIn('estado',['4'])
                ->get();
        }
        return response()->json($Reparaciones);
    }
    public function show($id){

        $Reparacion=Reparacion::with('cliente')->with('herramienta')
                ->with('diagnostico')
                ->where('id',$id)->first();
        
        $piezas=[];
        if($Reparacion->diagnostico!=null){
            $piezas=DetalleDiagnostico::with('pieza')->where('diagnostico_id',$Reparacion->diagnostico->id)->get();
        }
        return response()->json([
            "reparacion"    =>  $Reparacion,
            "piezas"      =>  $piezas,
        ]);

        // return response()->json($Reparacion);
    }

    public function nota(Request $request){
        $siguiente=Reparacion::select(DB::raw('count(id)+1 as siguiente'))
                ->first()->siguiente;
        $Reparacion=new Reparacion();
        $Reparacion->codigo=str_pad($siguiente,8, "0", STR_PAD_LEFT);
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
