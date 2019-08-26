<?php

namespace App\Http\Controllers;

use App\Model\DetalleCompra;
use App\Model\Compra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail  ;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras=Compra::with('proveedor')->get();
        return response()->json($compras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /**¨
         * Sin Items de compra
         */
        if($request->proveedor_id==null){
            return response()->json(["status"=>"ERROR","data"=>"Selecciones un proveedor"]);
        }
        if($request->documento==null){
            return response()->json(["status"=>"ERROR","data"=>"EL documento es necesario"]);
        }
        if($request->items==null){
            return response()->json(["status"=>"ERROR","data"=>"La compra no contiene Items"]);
        }

        DB::beginTransaction();

        try {
            
            $compra=new Compra();
            $compra->numcompra=$request->documento;
            $compra->proveedor_id=$request->proveedor_id;;
            $compra->save();

            /**
             * detalle compra
             */
            foreach ($request->items as $key => $item) {
                $detalleCompra=new DetalleCompra();
                $detalleCompra->cantidad=$item['cantidad'];
                $detalleCompra->pieza_id=$item['pieza_id'];
                $detalleCompra->compra_id=$compra->id;
                $detalleCompra->save();
            }

            $detalle=DetalleCompra::where('compra_id',$compra->id)->get();

            $empresa=$compra->proveedor->nombre;
            $fecha=Carbon::now()->format('Y-m-d');
            $numcompra=$compra->numcompra;
            $pdf = \PDF::loadView('ordencompra.pdf', compact('empresa','fecha','numcompra','detalle'));
           
            Mail::send('ordencompra.email', ["empresa"=>$empresa], function ($message) use ($compra, $pdf, $numcompra) {
                $message->subject('orden de compra de Tecnicentro');
                $message->to('paloominounprg@gmail.com');
                // $message->to($compra->proveedor->email);
                $message->attachData ($pdf->output(), 'tecnicento'.$numcompra.'.pdf');
            });
            
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $compra,
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
        $compras=DetalleCompra::with('pieza')->where('compra_id',$id)->get();
        $compra=Compra::with('proveedor')->where('id',$id)->first();
        return response()->json([
            "detalles"    =>  $compras,
            "compra"      =>  $compra,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $compra=Compra::where('id',$id)->first();
        $compra->estado='1';
        $compra->save();

        return response()->json([
                "status"    =>  "OK",
                "data"      =>  'Compra recibida'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
