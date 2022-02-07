@extends('layouts.business')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="row titlePage m-0 p-0" style="margin-right:240px!important;">
         Wybierz rodzaj usługi
      </div>
      <div class="row mt-5">
         <a href="{{route('business.register', 'room')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Budynek
            </div>
            <div class="businessBoxButtonDescription">
               Lokal, dworek, sala
            </div>
         </a>
         <a href="{{route('business.register', 'music')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Muzyka
            </div>
            <div class="businessBoxButtonDescription">
               Zespół muzyczny, DJ
            </div>
         </a>
         <a href="{{route('business.register', 'photo')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Fotograf
            </div>
            <div class="businessBoxButtonDescription">
               Kamerzysta, fotograf, dron
            </div>
         </a>
         <a href="{{route('business.register', 'decoration')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Dekoracje
            </div>
            <div class="businessBoxButtonDescription">
               Sale, samochody, napisy
            </div>
         </a>
         <a href="{{route('business.register', 'attraction')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Atrakcje
            </div>
            <div class="businessBoxButtonDescription">
               Teatr ognia, fontanna czekolady, pokazy
            </div>
         </a>
         <a href="{{route('business.register', 'catering')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Catering
            </div>
            <div class="businessBoxButtonDescription">
               Catering, fontanna czekolady, szwedzki stół
            </div>
         </a>
         <a href="{{route('business.register', 'shop')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Sklep
            </div>
            <div class="businessBoxButtonDescription">
               Salon sukien, garnitury, prezenty, obrączki
            </div>
         </a>
         <a href="{{route('business.register', 'services')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Usługi
            </div>
            <div class="businessBoxButtonDescription">
               Barman, fryzjer, uroda, barista
            </div>
         </a>
         <a href="{{route('business.register', 'rent')}}" class="text-decoration-none businessBoxButtonCategory">
            <div class="businessBoxButtonTitle">
               Wynajem
            </div>
            <div class="businessBoxButtonDescription">
               Auto do wynajęcia, fotobudka, bryczka, napis LOVE
            </div>
         </a>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $( ".businessBoxButton" ).hover(
        
    function() 
    {
        $( this ).append( $( "<span> ***</span>" ) );
    }, 
    function() {
        $( this ).find( "span" ).last().remove();
    }
   );
</script>
@endpush