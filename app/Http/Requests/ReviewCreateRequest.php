<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
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
            'iduser'         => 'required|numeric',
            'idjuego'        => 'required|numeric',
            'estado'         => 'required|in:Completado,Jugando,Abandonado,Pendiente',
            'score'          => 'nullable|numeric|max:10|min:0|regex:/^[\d]{0,2}(\.[\d]{1})?$/',
            'comentario'     => 'nullable|string',
            'favorito'       => 'nullable|in:1,0',
        ];
    }
    
    public function attributes() {
        return [
            'iduser'         => 'usuario',
            'idjuego'         => 'juego',
            'estado'        => 'estado',
            'score'        => 'puntuación',
            'comentario'      => 'comentario',
            'favorito'      => 'favorito',
        ];
    }
    
    public function messages() {
        $in             = 'El campo \':attribute\' no tiene el valor correcto, los valores permitidos son: \':values\'.';
        $max            = 'La longitud máxima del campo \':attribute\' es de :max caracteres.';
        $min            = 'La longitud mínima del campo \':attribute\' es de :min caracteres.';
        $regex          = 'El campo \':attribute\' debe tener el formato de de un número del 0 al 10 con un máximo de un decimal.';
        $numeric        = 'El campo \':attribute\' debe ser un número.';
        $string         = 'El campo \':attribute\' debe ser una cadena de caracteres.';
        $required       = 'El campo \':attribute\' es obligatorio.';
        return [
            'idjuego.required'     => $required,
            'estado.required'    => $required,
            'favorito.required'    => $required,
            'score.max'          => $max,
            'score.min'         => $min,
            'score.numeric'     => $numeric,
            'score.regex'       => $regex,
            'comentario.string'        => $string,
            'favorito.in'     => $in,
            'iduser.required' => $required,
            'iduser.numeric' => $numeric,
            'idjuego.numeric' => $numeric,
        ];
    }
}
