<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="logos rectangle orange">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Логин</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                                </li>
                            @endif
                        @else
                            <div class="d-flex justify-content-center text-center align-items-center mr-3">
                                <a class="cabinet" href="{{route('cabinet')}}">Кабинет</a>
                            </div>
                            <div class="d-flex justify-content-center text-center align-items-center mr-3">
                                <label class="mb-0"><img class="ml-2" title="Влияние" width="16px" src="{{asset('img/impact.png')}}">{{Auth::user()->impact}}</label>
                                <label class="mb-0"><img class="ml-2" title="Радость" width="16px" src="{{asset('img/happy.png')}}">{{Auth::user()->happy}}</label>
                                <label class="mb-0"><img class="ml-2" title="Здоровье" width="20px" src="{{asset('img/health.png')}}">{{Auth::user()->health}}</label>
                                <label class="mb-0"><img class="ml-2" src="{{asset('img/coin.png')}}" >{{Auth::user()->money}}</label>
                                <label class="mb-0"><img class="ml-2" title="Энергия" src="{{asset('img/lightning.png')}}">{{Auth::user()->energy}}</label>
                            </div>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <form method="POST" action="{{route('step')}}">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="Сделать ход">
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if (session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
                {{session()->forget('status')}}
            @endif
            @yield('content')
        </main>
        <div class="row">
            <div class="col-md-12">
                <div class="content-footer grow text-center p-3 mt-5">
                    gamen1.com @ Elaman 2020, 12+
                </div>
            </div>
        </div>
    </div>
</body>
</html>
