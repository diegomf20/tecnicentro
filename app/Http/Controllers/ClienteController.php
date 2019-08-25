<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Cliente;
use Carbon\Carbon;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $clientes=Cliente::all();
        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cliente= new Cliente();
            $cliente->dni=$request->dni;
            $cliente->nombre=$request->nombre;
            $cliente->apellido=$request->apellido;
            $cliente->direccion=$request->direccion;
            $cliente->numero=$request->numero;
            $cliente->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $cliente
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
        $cliente= Cliente::where('id',$id)->first();
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $cliente= Cliente::where('id',$id)->first();
            $cliente->dni=$request->dni;
            $cliente->nombre=$request->nombre;
            $cliente->apellido=$request->apellido;
            $cliente->direccion=$request->direccion;
            $cliente->numero=$request->numero;
            $cliente->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $cliente,
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

            $cliente= Cliente::where('id',$id)->first();
            if($cliente->estado=='2'){
                return response()->json([
                    "status"    =>  "WARNING",
                    "data"      =>  "Cliente no puede desactivarse",
                ]);
            }
            
            $estado = ($cliente->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $cliente->estado=$estado;
            $cliente->save();

            $estado = ($cliente->estado=='0') ? 'Cliente activado ': 'Cliente desactivado';

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
