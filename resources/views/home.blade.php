<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">



        <style>
            body {
                font-family: sans-serif;
            }
            a{
                text-align: center;
                text-decoration: blue;
                
            }
            .menu{
                float: right;
            }
            .logRegDash{
                float: right;
            }
            .btn-center{
                display: flex;
                align-items: center;
                justify-content: center;
            }
            button{
                height: 30px;
                border-radius: 5px;

            }
            button:hover{
                background: rgb(238,174,202);
                background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
            }
        </style>
    </head>
    <body style="background-image: url({{asset('img/foto.jpg')}})">
        <div >
            @if (Route::has('login'))
                <div class="logRegDash hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

            <marquee direction="left">
                <h1>Good day @auth {{auth()->user()->name}}@endauth. Push on "Betters and horses list" to start your work </h1>
            </marquee>
        <div class="btn-center">
            <button><a href="{{route('better.index')}}">Betters and horses list</a></button>
        </div>
    </body>
</html>
