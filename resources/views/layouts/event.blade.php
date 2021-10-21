<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @can('isUser')
                                <a href="{{ route('user.events') }}" class="mr-3">Wydarzenia</a>
                                <a href="{{ route('event.date') }}" class="mr-3">Kalendarz</a>
                                <a href="{{ route('event.finances') }}" class="mr-3">Finanse</a>
                                <a href="{{ route('event.guest') }}" class="mr-3">Goście</a>  
                                <a href="{{ route('event.like') }}" class="mr-3">Polubione</a>  
                                <a href="{{ route('event.tasks') }}" class="mr-3">Zadania</a>  
                                <a href="{{ route('event.notifications') }}" class="mr-3">
                                    @if(!empty($notifications))
                                        Powiadomienia({{count($notifications)}})
                                    @else
                                        Powiadomienia
                                    @endif
                                </a>  
                                <a href="{{ route('event.reservations') }}" class="mr-3">Rezerwacje</a>  
                            @endcan

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        var base_url = '{{url("/")}}';
    </script>
    <script src="{{ asset('js/notifications.js') }}"></script>
    @stack('calendar')
    @stack('business')
    @stack('notify')
    @stack('script')
</body>

</html>
