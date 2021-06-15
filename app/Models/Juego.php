<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;
    
    const TABLA = 'juego';
    protected $table = self::TABLA;
    
    protected $attributes = ['descripcion' => 'Este juego todavía no tiene descripción.', 'averagescore' => 0];
    
    protected $fillable = [
                'id',
                'nombre', 
                'empresa',
                'plataforma',
                'releasedate',
                'generos',
                'descripcion',
                'foto',
                'averagescore',
        ];
        
        //tabla review 1, tabla juego n
        function reviews(){
             return $this->hasMany('App\Models\Review', 'idjuego');

        }
        
        protected $primaryKey = 'id';

}
