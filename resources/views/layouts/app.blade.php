<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://p.w3layouts.com/demos/cars_online/web/css/style.css">
		<link rel="stylesheet" href="{{url('css/style.css')}}">
		
    </head>
    <body>

</div> 
<div class="header-bg">
    <div class="wrap"> 
        <div class="h-bg">
                <div class="header">
                    <div class="clear"></div> 
                    <div class="header-bot">
                        <div>
                            <h1 style="color:;font-weight:bold;font-size:40px;">GAMERD</h1>
                            <div style="text-align:right;">
                            @guest
                                @if (Route::has('login'))
                                <span><a href="{{url('login')}}">Login</a> </span>
                                @endif
                                @if (Route::has('register'))
                                <span><a href="{{url('register')}}">Register</a></span>
                                @endif
                            @else
                                <span><a href="{{url('user/' . Auth::user()->id) }}">{{ Auth::user()->name }}</a></span>
                                <span><a href="{{route('logout')}}">Logout</a></span>
                            @endguest
                            </div>
                        </div>
                        <div class="clear"></div> 
                    </div>		
                </div>	
                <div class="menu"> 	
                    <div class="top-nav"> 
                        <ul>
                            <li><a href="{{url('/')}}">Juegos</a></li>
                            <li><a href="{{url('user/index')}}">Comunidad</a></li>
                        </ul>
                        <div class="clear"></div> 
                    </div>
                </div>
                <div class="banner-top">
                    <div class="header-bottom">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="footer-bottom">
                        <div class="copy">
                            <p>&copy; 2021 Gamerd. All rights reserved | Design by <a href="http://w3layouts.com">W3Layouts</a></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

</body>
</html>