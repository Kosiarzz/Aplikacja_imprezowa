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

      <!-- Calendar -->
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
                  <!--<a id="dashboard" href="{{ route('service.dashboard') }}" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-table fa-fw mr-2"></i><span>Panel główny</span>
                  </a>-->
                  <a id="preview" href="{{ route('service.preview') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-globe fa-fw mr-2"></i><span>Podgląd</span></a
                     >
                  <a id="calendarMenu" href="{{ route('service.calendar') }}" class="list-group-item list-group-item-action py-2 ripple">
                     <i class="fas fa-calendar-alt fa-fw mr-2"></i><span>Kalendarz</span></a>
                  <a id="notifications" href="{{ route('service.notifications') }}" class="list-group-item list-group-item-action py-2 ripple" style="padding-right:0!important;"
                     ><i class="fas fa-bell fa-fw mr-1"></i>
                  @if(!empty($notifications) && count($notifications) != 0)
                    Powiadomienia <span class="badge rounded-pill badge-notification bg-danger">{{count($notifications)}}</span>
                  @else
                    Powiadomienia
                  @endif
               </a>
                  <a id="reservations" href="{{ route('service.reservations') }}" class="list-group-item list-group-item-action py-2 ripple">
                     <i class="fas fa-clipboard-list fa-fw mr-2"></i><span>Rezerwacje</span></a>
                  <a id="stats" href="{{ route('service.stats') }}" class="list-group-item list-group-item-action py-2 ripple">
                  <i class="fas fa-chart-bar fa-fw mr-2"></i><span>Statystyki</span>
                  </a>
                  
                  <a id="servicePreview" href="{{ route('service.previewService') }}" class="list-group-item list-group-item-action py-2 ripple"
                     ><i class="fas fa-shopping-cart fa-fw mr-2"></i><span>Oferty</span></a
                     >
                  
                  <a id="services" href="{{ route('business.index') }}" class="list-group-item list-group-item-action py-2 ripple active">
                  <i class="fas fa-list fa-fw mr-2"></i><span>Wszystkie usługi</span>
                  </a>
               </div>
            </div>
         </nav>
         <!-- Sidebar -->
         <!-- Navbar -->
         <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
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
               <a class="navbar-brand p-0 m-0" href="{{route('frontend.index')}}">
                    <span class="pageName">Zaplanuj</span><span class="pagePl">.pl</span>
               </a>
               <!-- Right links -->
               <ul class="navbar-nav ms-auto d-flex flex-row">
                  <!-- Avatar -->
                  <div class="dropdown">
                     <img src="{{asset('storage/'.session('avatar'))}}" class="rounded-circle avatar-circle dropdown-toggle dropdown-img border" alt="" loading="lazy" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                     <div class="dropdown-menu dropdown-event" aria-labelledby="dropdownMenuButton" style="left:-100px!important; border:0!important;">
                           <a class="dropdown-item" href="{{ route('business.index') }}">Usługi</a>
                           <a class="dropdown-item" href="{{ route('business.profile') }}">Profil</a>
                           <a class="dropdown-item border-top" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                           </form>
                     </div>
                  </div>
                  
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
      <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('service_chart')",
      });
    </script>
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