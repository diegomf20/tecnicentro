<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Reparacion;
use App\Model\Diagnostico;

class ReparacionController extends Controller
{
    public function index(){
        $Reparaciones=Reparacion::with('cliente')->with('herramienta')->get();
        return response()->json($Reparaciones);
    }
    public function show($id){
        $Reparacion=Reparacion::with('cliente')->with('herramienta')
                ->where('id',$id)->first();
        return response()->json($Reparacion);
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
        $diagnostico->descripcion=$request->descripcion;
        $diagnostico->save();
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
}
