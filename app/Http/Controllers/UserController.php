<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioValidation;
use App\Http\Requests\UsuarioUpdataValidation;

use App\Model\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        $usuarios=User::all();
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioValidation $request)
    {
        DB::beginTransaction();

        try {
            $usuario= new User();
            $usuario->nombre=$request->nombre;
            $usuario->apellido=$request->apellido;
            $usuario->usuario=$request->usuario;
            $usuario->password=$request->password;
            $usuario->numero=$request->numero;
            $usuario->estado='0';
            $usuario->rol=$request->rol;
            $usuario->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  ($request->data==true) ? $usuario : "usuario Guardado",
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
        $usuario= User::where('id',$id)->first();
        return response()->json($usuario);
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
    public function update(UsuarioUpdataValidation $request, $id)
    {
        DB::beginTransaction();

        try {
            $usuario= User::where('id',$id)->first();
            $usuario->nombre=$request->nombre;
            $usuario->apellido=$request->apellido;
            $usuario->usuario=$request->usuario;
            $usuario->password=$request->password;
            $usuario->numero=$request->numero;
            $usuario->estado='0';
            $usuario->rol=$request->rol;
            $usuario->save();

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  ($request->data==true) ? $usuario : "Usuario Actualizado",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    public function cambiar_Estado($id)
    {
        DB::beginTransaction();

        try {

            $usuario= User::where('id',$id)->first();
            if($usuario->estado=='2'){
                return response()->json([
                    "status"    =>  "WARNING",
                    "data"      =>  "Usuario no puede desactivarse",
                ]);
            }
            
            $estado = ($usuario->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $usuario->estado=$estado;
            $usuario->save();

            $estado = ($usuario->estado=='0') ? 'Usuario activado ': 'Usuario desactivado'; //saber el estado cambiado para mostrar el mensaje

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

    public function cambiar_contrasenia(UsuarioPasswordUpdateValidation $request)
    {
        DB::beginTransaction();
        $usuario=User::where('id',session('user_id'))->first();

        if(Hash::check($request->passwordactual, $usuario->password)){
            try{
                // $usuario->password = Hash::make($request->password);
                $usuario->password = bcrypt($request->passwordnuevo);
                $usuario->save();
                DB::commit();
                return response()->json([
                    "status"    =>  "OK",
                    "data"      =>  "Nueva contraseña guardada correctamente",
                ]);
            }catch(\Exception $e){
                DB::rollback();
                return response()->json([
                    "status"    =>  "DANGER",
                    "data"      =>  $e->getMessage()
                ]);
            };
        }else{
            return response()->json([
                "status"    =>  "WARNING",
                "data"      =>  "La contraseña actual no es correcta",
            ]);
        }
    }

}
