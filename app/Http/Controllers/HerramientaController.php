<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Herramienta;
use Carbon\Carbon;

class HerramientaController extends Controller
{
    public function index(Request $request)
    {
        $Herramientas=Herramienta::all();
        return response()->json($Herramientas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $siguiente=Herramienta::select(DB::raw('count(id)+1 as siguiente'))
                ->first()->siguiente;
            $Herramienta= new Herramienta();
            $Herramienta->codigo=str_pad($siguiente,5, "0", STR_PAD_LEFT);
            $Herramienta->nombre=$request->nombre;
            $Herramienta->estado='0';
            $Herramienta->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Herramienta
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Herramienta= Herramienta::where('id',$id)->first();
        return response()->json($Herramienta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $Herramienta= Herramienta::where('id',$id)->first();
            $Herramienta->nombre=$request->nombre;
            $Herramienta->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Herramienta,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    public function estado($id)
    {
        DB::beginTransaction();

        try {

            $Herramienta= Herramienta::where('id',$id)->first();
            
            $estado = ($Herramienta->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $Herramienta->estado=$estado;
            $Herramienta->save();

            $estado = ($Herramienta->estado=='0') ? 'Herramienta activado ': 'Herramienta desactivado'; //saber el estado cambiado para mostrar el mensaje

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $estado,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }
}
