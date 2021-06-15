<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewEditRequest;
use App\Http\Requests\ReviewCreateRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $juegos = Juego::all();
        $estados = ['Completado' => 'Completado', 'Jugando' => 'Jugando', 'Abandonado' => 'Abandonado', 'Pendiente' => 'Pendiente'];
        return view('review.create')->with(['estados' => $estados, 'juegos' => $juegos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*echo 'hola';
        exit; */
        $review = new Review($request->all());
        $review->iduser = Auth::id();
        
        $review->save();   
        return redirect('user/'. $review->iduser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $juegos = Juego::all();
        $estados = ['Completado' => 'Completado', 'Jugando' => 'Jugando', 'Abandonado' => 'Abandonado', 'Pendiente' => 'Pendiente'];
        return view('review.edit')->with(['estados' => $estados, 'juegos' => $juegos, 'review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $review->estado = $request->input('estado');
        $review->score = $request->input('score');
        $review->comentario = $request->input('comentario');
        $review->favorito = $request->input('favorito');
        
        $review->save();
        return redirect('user/'. $review->iduser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return back();
    }
}
