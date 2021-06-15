@extends('layouts.app')

@section('content')

<h1 style="font-weight:bold">Explora todos los juegos</h1>
<div style="float:right;">
    <form action="{{ url('/') }}" method="get">
         <input value="{{ $search ?? '' }}" type="text" name="search" placeholder="búsqueda"/>
         <input type="submit" value="Filter"/>
         <label for="sort">↓</label>
         <input type="radio" name="sort" value="asc" {{ $sort=='asc' ? 'checked' : '' }}>
         <label for="sort">↑</label>
         <input type="radio" name="sort" value="desc" {{ $sort=='desc' ? 'checked' : '' }}>
    </form>
</div>
@auth
    @if(auth()->user()->id == 1)
        <h3 style="margin-top:15px;"><a href="{{ url('juego/create') }}">Crear juego</a></h3>
    @endif
@endauth
</br>
<hr>

<ul>
    @foreach($juegos as $juego)
        <li>
            <img src="{{ url('img/' . $juego->nombre.'.jpg') }}" style="width:15%;">
             <!-- <img src="data:image/*;charset=utf8;base64, {{base64_encode($juego->foto)}}" />-->

            {{ $juego->nombre }}
            <a href="{{ url('juego/' . $juego->id) }}" style="margin-left:20px;">Ver detalles</a>
            @auth
                @if(auth()->user()->id == 1)
                    <a href="{{ url('juego/' . $juego->id . '/edit') }}" style="float:right">Editar</a>
                @endif
            @endauth
        </li>
        <hr>
    @endforeach    
            {{ $juegos->appends(['search' => $search, 'sort' => $sort])->onEachSide(1)->links("pagination::bootstrap-4") }}
</ul>

@endsection