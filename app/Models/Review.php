<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    const TABLA = 'review';
    protected $table = self::TABLA;
    
    protected $attributes = ['favorito' => false];
    
    protected $fillable = [
            'id',
            'iduser', 
            'idjuego',
            'estado',
            'score',
            'comentario',
            'favorito',
    ];
    
    //tabla review 1, tabla juego n
        function juego(){
             return $this->belongsTo('App\Models\Juego', 'idjuego');

        }
        
    //tabla review 1, tabla user n
        function user(){
             return $this->belongsTo('App\Models\User', 'iduser');

        }
        
        protected $primaryKey = 'id';
}
