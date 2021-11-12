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

      
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    


   </head>
   <body>
      <!--Main Navigation-->
      <header>
         <!-- Sidebar -->
         <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
               <div class="list-group list-group-flush mx-3 mt-4">
                  <a id="dashboard" href="{{ route('event.dashboardView') }}" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-chart-area fa-fw me-3"></i><span>Panel główny</span>
                  </a>
                  <a id="date" href="{{ route('event.date') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-lock fa-fw me-3"></i><span>Kalendarz</span></a
                     >
                  <a id="finance" href="{{ route('event.finances') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-chart-line fa-fw me-3"></i><span>Finanse</span></a
                     >
                  <a id="guest" href="{{ route('event.guest') }}" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-chart-pie fa-fw me-3"></i><span>Goście</span>
                  </a>
                  <a id="service" href="{{ route('event.services') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Usługi</span></a
                     >
                  <a id="task" href="{{ route('event.tasks') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-globe fa-fw me-3"></i><span>Zadania</span></a
                     >
                  <a id="notification" href="{{ route('event.notifications') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-building fa-fw me-3"></i><span>
                  @if(!empty($notifications) && count($notifications) != 0)
                    Powiadomienia 
                    <i class="fas fa-bell"></i>
                     <span class="badge rounded-pill badge-notification bg-danger">{{count($notifications)}}</span>
                     </a>
                  @else
                    Powiadomienia
                  @endif
               </span></a>
                  <a id="reservation" href="{{ route('event.reservations') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-calendar fa-fw me-3"></i><span>Rezerwacje</span></a
                     >
                  <a id="events" href="{{ route('user.events') }}" class="list-group-item list-group-item-action py-2 ripple active">
                  <i class="fas fa-chart-area fa-fw me-3"></i><span>Wszystkie wydarzenia</span>
                  </a>
               </div>
            </div>
         </nav>
         <!-- Sidebar -->
         <!-- Navbar -->
         <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white border-secondary fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
               <!-- Toggle button -->
               <button
                  class="navbar-toggler"
                  type="button"
                  data-mdb-toggle="collapse"
                  data-mdb-target="#sidebarMenu"
                  aria-controls="sidebarMenu"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                  >
               <i class="fas fa-bars"></i>
               </button>
               <!-- Brand -->
               <a class="navbar-brand" href="#">
               <img
                  src="x"
                  height="25"
                  alt=""
                  loading="lazy"
                  /> logo/nazwa ({{session('event')}})
               </a>
               <!-- Right links -->
               <ul class="navbar-nav ms-auto d-flex flex-row">
                  <!-- Notification dropdown -->
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
                  <li class="nav-item dropdown">
                     <a
                        class="nav-link  hidden-arrow d-flex align-items-center"
                        href="#"
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
                  </li>
               </ul>
            </div>
            <!-- Container wrapper -->
         </nav>
         <!-- Navbar -->
      </header>
      <!--Main Navigation-->
      <main class="py-4 mb-5">
         @yield('content')
      </main>
      </div>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

      
      
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