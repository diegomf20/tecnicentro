<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Proveedor;
use Carbon\Carbon;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $proveedors=Proveedor::all();
        return response()->json($proveedors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $proveedor= new Proveedor();
            $proveedor->ruc=$request->ruc;
            $proveedor->nombre=$request->nombre;
            $proveedor->email=$request->email;
            $proveedor->numero=$request->numero;
            $proveedor->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $proveedor
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
        $proveedor= Proveedor::where('id',$id)->first();
        return response()->json($proveedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $proveedor= Proveedor::where('id',$id)->first();
            $proveedor->ruc=$request->ruc;
            $proveedor->nombre=$request->nombre;
            $proveedor->email=$request->email;
            $proveedor->numero=$request->numero;
            $proveedor->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $proveedor,
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

            $proveedor= Proveedor::where('id',$id)->first();
            if($proveedor->estado=='2'){
                return response()->json([
                    "status"    =>  "WARNING",
                    "data"      =>  "proveedor no puede desactivarse",
                ]);
            }
            
            $estado = ($proveedor->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $proveedor->estado=$estado;
            $proveedor->save();

            $estado = ($proveedor->estado=='0') ? 'proveedor activado ': 'proveedor desactivado';

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
