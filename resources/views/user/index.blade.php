@extends('layouts.app')

@section('content')

<h1 style="font-weight:bold">¡Conoce a la comunidad!</h1>
<hr>

<ul>
    @foreach($users as $user)
        <li>

            @if(isset($user->fotoperfil))
                <img src="data:image/jpg;charset=utf8;base64, {{base64_encode($user->fotoperfil)}}" style="margin-right:15px;width:15%;"/>
            @else
                <img src="{{ url('img/' . 'defaultprofilepicture.jpg') }}" style="margin-right:15px">
            @endif

            {{ $user->name }}
            <a href="{{ url('user/' . $user->id) }}">Ver perfil</a>
        </li>
        <hr>
    @endforeach    
</ul>

@endsection