<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class LoginController extends Controller
{
    public function ingresar(Request $request){
        $user=User::where('usuario',$request->usuario)
            ->where('password',$request->password)
            ->first();
        if ($user!=null) {
            return response()->json([
                'status'=>'OK',
                'data'=>$user
            ]);
        }else{
            return response()->json([
                'status'=>'INFO',
                'data'=>'Usuario o contraseña incorrecto.'
            ]);
        }
    }
}
