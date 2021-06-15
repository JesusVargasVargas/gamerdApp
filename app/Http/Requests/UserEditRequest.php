<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'email'         => 'required|string|max:255|email|unique:user,email,' . auth()->user()->id . ',id',
            'name'          => 'required|string|max:255',
            'newpassword'   => 'nullable|string|min:8|confirmed',
            'biografia'     => 'nullable|string',
            'fotoperfil'    => 'nullable|mimes:jpeg,jpg,png,gif,webp',
        ];
    }
    
    public function attributes() {
        return [
            'email'         => 'correo electrónico',
            'name'          => 'nombre',
            'newpassword'   => 'clave de acceso',
            'biografia'     => 'biografía',
            'fotoperfil'    => 'foto de perfil'
        ];
    }
    
    public function messages() {
        $confirmed  = 'No coinciden las dos claves de acceso.';
        $email      = 'El campo \':attribute\' no tiene el formato de correo requerido.';
        $max        = 'La longitud máxima del campo \':attribute\' es de :max caracteres.';
        $min        = 'La longitud mínima del campo \':attribute\' es de :min caracteres.';
        $required   = 'El campo \':attribute\' es obligatorio.';
        $string     = 'El campo \':attribute\' tiene que ser una cadena de caracteres.';
        $unique     = 'El correo electrónico ya está siendo usado por otro usuario.';
        $mimes      = 'El archivo subido no tiene el formato correcto (jpeg, jpg, png, gif, wepb).';
        return [
            'email.required'        => $required,
            'email.string'          => $string,
            'email.max'             => $max,
            'email.email'           => $email,
            'email.unique'          => $unique,
            'name.required'         => $required,
            'name.string'           => $string,
            'name.max'              => $max,
            'newpassword.string'    => $string,
            'newpassword.min'       => $min,
            'newpassword.confirmed' => $confirmed,
            'biografia.string'      => $string,
            'fotoperfil.mimes'      => $mimes,
        ];
    }
    
}
