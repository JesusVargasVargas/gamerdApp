<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Juego;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('user.index')->with(['users' => $users]);
    }
    
    public function show(User $user)
    {
        $reviews = Review::where('iduser', $user->id)->orderBy('idjuego', 'asc')->get();
        
        $ids= array();
        $cont=0;
        foreach($reviews as $review){
                //$juego = Juego::where('id',$review->idjuego)->get();
                //$juegosconreview[$cont] = $juego;
                $ids[$cont] = $review->idjuego;
                $cont++;   
        }
        $juegosconreview = Juego::find($ids);
        
        //dd($juegosconreview);
        return view('user.show')->with(['user' => $user, 'reviews' => $reviews, 'juegosconreview' => $juegosconreview]);
    }
}
