<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Pieza;
use Carbon\Carbon;

class PiezaController extends Controller
{
    public function index(Request $request)
    {
        $Piezas=Pieza::all();
        return response()->json($Piezas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $siguiente=Pieza::select(DB::raw('count(id)+1 as siguiente'))
                ->first()->siguiente;
            $Pieza= new Pieza();
            $Pieza->codigo=str_pad($siguiente,5, "0", STR_PAD_LEFT);
            $Pieza->nombre=$request->nombre;
            $Pieza->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Pieza
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
        $Pieza= Pieza::where('id',$id)->first();
        return response()->json($Pieza);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $Pieza= Pieza::where('id',$id)->first();
            $Pieza->nombre=$request->nombre;
            $Pieza->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Pieza,
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
