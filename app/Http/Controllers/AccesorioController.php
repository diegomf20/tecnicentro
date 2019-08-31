<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Accesorio;
use Carbon\Carbon;

class AccesorioController extends Controller
{
    public function index(Request $request)
    {
        $Accesorios=Accesorio::all();
        return response()->json($Accesorios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $siguiente=Accesorio::select(DB::raw('count(id)+1 as siguiente'))
                ->first()->siguiente;
            $Accesorio= new Accesorio();
            $Accesorio->codigo=str_pad($siguiente,5, "0", STR_PAD_LEFT);
            $Accesorio->nombre=$request->nombre;
            $Accesorio->modelo=$request->modelo;
            $Accesorio->stock=$request->stock;
            $Accesorio->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Accesorio
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
        $Accesorio= Accesorio::where('id',$id)->first();
        return response()->json($Accesorio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $Accesorio= Accesorio::where('id',$id)->first();
            $Accesorio->nombre=$request->nombre;
            $Accesorio->modelo=$request->modelo;
            $Accesorio->stock=$request->stock;
            $Accesorio->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $Accesorio,
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
