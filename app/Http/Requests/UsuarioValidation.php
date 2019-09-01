<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\JsonResponse;

use App\Rules\NumeroRule;

class UsuarioValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>['required','max:30'],
            'apellido'=>['required','max:50'],
            'rol'=>['required'],
            'password'=>['required','max:100'],
            'numero'=>['required',new NumeroRule()],
            'usuario'=>'required|max:100|unique:user,usuario'
        ];
    }

    public function messages(){
        return [
        ];
    }

    protected function failedValidation(Validator $validator) {
        //extraer array
        $sin_array=str_replace(["[","]"], "",json_encode($validator->errors()));
        
        throw new HttpResponseException(response()->json([
            "status" => "VALIDATION",
            "data"   =>  json_decode($sin_array)
        ], 200));
    }
}
