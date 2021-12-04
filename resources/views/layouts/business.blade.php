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
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
               <!-- Toggle button -->
               <b   utton
                  class="navbar-toggler"
                  type="button"
                  data-mdb-toggle="collapse"
                  data-mdb-target="#sidebarMenu"
                  aria-controls="sidebarMenu"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                  >
               <i class="fas fa-bars"></i>
               </b>
               <!-- Brand -->
               <a class="navbar-brand" href="#">
               <img
                  src="x"
                  height="25"
                  alt=""
                  loading="lazy"
                  /> logo/nazwa
               </a>
               <!-- Right links -->
               <ul class="navbar-nav ms-auto d-flex flex-row">
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
                        @can('isBusiness')
                        <li class="nav-item"><a class="dropdown-item" href="{{ route('business.index') }}" class="mr-3">Usługi</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="{{ route('business.notifications') }}" class="mr-3">Powiadomienia</a></li>
                        @endcan

                  <li class="nav-item">
                     <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                     </form>
                  </li>


                  <!-- Avatar -->
                     <a
                        class="nav-link hidden-arrow d-flex align-items-center"
                        href="{{ route('business.profile') }}"
                        id="navbarDropdownMenuLink"
                        role="button"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false"
                        >
                     <img
                        src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                        class="rounded-circle"
                        height="22"
                        alt=""
                        loading="lazy"
                        />
                     </a>
                    @endguest
               </ul>
            </div>
            <!-- Container wrapper -->
         </nav>
         <!-- Navbar -->
    <main class="py-4 mt-5">
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
    
    @stack('calendar')
    @stack('business')
    @stack('script')
    
</body>

</html>
