<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail 
{
    use HasFactory, Notifiable;
    
    const TABLA = 'user';
    protected $table = self::TABLA;
    
    protected $attributes = ['biografia' => 'Este usuario todavía no tiene biografía'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', //?????¿
        'name',
        'email',
        'biografia',
        'fotoperfil',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //tabla review 1, tabla user n
        function reviews(){
             return $this->hasMany('App\Models\Review', 'iduser');

        }
}
