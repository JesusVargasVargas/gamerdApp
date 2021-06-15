<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JuegoEditRequest extends FormRequest
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
            'nombre'         => 'required|string|max:50',
            'empresa'          => 'required|string|max:50',
            'plataforma'   => 'required',
            'releasedate'          => 'required|date',
            'generos'          => 'required',
            'descripcion'          => 'required|string|max:1000',
            'foto'          => 'required|mimes:jpeg,jpg,png,gif,webp',
            //'averagescore'          => 'required|numeric',
        ];
    }
    
    public function attributes() {
        return [
            'nombre'         => 'nombre',
            'empresa'          => 'empresa',
            'plataforma'   => 'plataformas',
            'releasedate'     => 'fecha de salida',
            'generos'    => 'generos',
            'descripcion'    => 'descripcion',
            'foto'    => 'foto',
            //'averagescore'    => 'puntuación media',
        ];
    }
    
    public function messages() {
        $max        = 'La longitud máxima del campo \':attribute\' es de :max caracteres.';
        $required   = 'El campo \':attribute\' es obligatorio.';
        $string     = 'El campo \':attribute\' tiene que ser una cadena de caracteres.';
        $mimes      = 'El archivo subido no tiene el formato correcto (jpeg, jpg, png, gif, wepb).';
        $numeric    = 'El campo \':attribute\' debe de ser numérico.';
        $date       = 'El campo \':attribute\' debe de ser una fecha.';
        return [
            'nombre.required'        => $required,
            'empresa.required'        => $required,
            'plataforma.required'        => $required,
            'releasedate.required'        => $required,
            'generos.required'        => $required,
            'descripcion.required'        => $required,
            'foto.required'        => $required,
            //'averagescore.required'        => $required,
            'nombre.string'          => $string,
            'empresa.string'          => $string,
            /*'plataforma.string'          => $string,
            'generos.string'          => $string,*/
            'descripcion.string'          => $string,
            'releasedate.date'          => $date,
            //'averagescore.numeric'          => $numeric,
            'foto.mimes'          => $mimes,
            'nombre.max'              => $max,
            'empresa.max'              => $max,
            'descripcion.max'              => $max,
        ];
    }
}
