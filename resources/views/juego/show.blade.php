@extends('layouts.app')

@section('content')

<ul style="line-height:120%;">
       
            <li>
               <!--  <img src="data:image/jpg;charset=utf8;base64, {{base64_encode($juego->foto)}}"/>    -->
                <img src="{{ url('img/' . $juego->nombre.'.jpg') }}">
            </li>
        <li style="font-weight:bold; font-size:130%;margin-left:20px;"> {{ $juego->nombre }} </li>
        <li>Puntuación media: <span style="color:#2065a1;">{{ $juego->averagescore }}</span></li>
        <li>Empresa: <span style="color:#2065a1;">{{ $juego->empresa }}</span> </li>
        <li>Plataformas: <span style="color:#2065a1;">{{ $juego->plataforma }}</span></li>
        <li>Fecha de salida: <span style="color:#2065a1;">{{ $juego->releasedate }}</span></li>
        <li>Géneros: <span style="color:#2065a1;">{{ $juego->generos }}</span></li>
        <li>{{ $juego->descripcion }}</li>

</ul>

@endsection