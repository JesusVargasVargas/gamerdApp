@extends('layouts.app')

@section('content')

<ul style="line-height:120%;background-color:#f7f5f0;padding:20px;">
        @if(isset($user->fotoperfil))
                <img src="{{ url('img/' . $user->email.'.jpg') }}" style="margin-right:15px;width:30%;">
                <!--<img src="data:image/jpg;charset=utf8;base64, {{base64_encode($user->fotoperfil)}}" style="margin-right:15px;width:30%;"/>-->
            @else
                <img src="{{ url('img/' . 'defaultprofilepicturebig.jpg') }}" style="margin-right:15px">
        @endif 
            </br> </br>
        <span style="font-weight:bold; font-size:130%;margin-left:20px;"> {{ $user->name }} </span>
            @auth
                @if(auth()->user()->id == $user->id)
            <span style="float:right;"><a href="{{ url('user/' . $user->id . '/edit') }}">Editar perfil</a></span>
                @endif
            @endauth

        <li style="margin-bottom:15px;margin-top:15px;">Biografía: {{ $user->biografia }}</li>
</br></br><hr></br>
        <li style="background-color:#e6e3dc;padding:10px;"> <span style="font-weight:bold;font-size:110%;text-decoration:underline;">Reviews:</span> </br></br>
            <ul>
                @auth
                    @if(auth()->user()->id == $user->id)
                    <span><a href="{{ url('review/create') }}">Crear review</a></span> </br> </br>
                    <hr>
                    @endif
                @endauth
                
                @foreach($reviews as $key => $review)
                    <li>
                        @auth
                            @if(auth()->user()->id == $user->id)
                            <span style="float:right;"><a href="{{ url('review/'. $review->id. '/edit') }}">Editar review</a></span>
                            @endif
                        @endauth
                        <!-- foto y nombre del juego -->
                        <span style="font-weight:bold;"><a href="{{ url('juego/'. $review->idjuego) }}">{{ $juegosconreview[$key]->nombre }}</a></span>
                        
                        @if($review->favorito)
                            <img src="{{ url('img/' . 'full.png') }}" style="float:right;">
                        @else
                            <img src="{{ url('img/' . 'hueca.png') }}" style="float:right;">
                        @endif
                        </br>
                        Estado: {{ $review->estado }} </br>
                        @if(isset($review->comentario))
                            Comentario: {{ $review->comentario}} </br>
                        @endif
                        @if(isset($review->score))
                            Valoración: {{ $review->score }} 
                        @endif
                        
                        @auth
                            @if(auth()->user()->id == $user->id)
                            </br></br>
                            <span style="float:right;">
                                <form method="POST" action="{{ url('review/'.$review->id.'/destroy') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"> Borrar review </button>
                                </form>
                            </span>
                            @endif
                        @endauth
                    </li>
                    </br><hr></br>
                @endforeach
            </ul>
        </li>
</ul>

@endsection