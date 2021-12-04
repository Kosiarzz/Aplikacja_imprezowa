@extends('layouts.business')
@section('content')
<div class="container">
   <div class="row justify-content-center">
   <div class="titlePage">
      Wybierz rodzaj usługi
   </div>
      <div class="row mt-5">
         <a href="{{route('business.register', 'room')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Budynek
            </div>
            <div class="businessBoxButtonDescription">
               Lokal, dworek, sala
            </div>
         </a>
         <a href="{{route('business.register', 'music')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Muzyka
            </div>
            <div class="businessBoxButtonDescription">
               Zespół muzyczny, DJ
            </div>
         </a>
         <a href="{{route('business.register', 'photo')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Fotograf
            </div>
            <div class="businessBoxButtonDescription">
               Kamerzysta, fotograf, dron
            </div>
         </a>
         <a href="{{route('business.register', 'decoration')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Dekoracje
            </div>
            <div class="businessBoxButtonDescription">
               Sale, samochody, napisy
            </div>
         </a>
         <a href="{{route('business.register', 'attraction')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Atrakcje
            </div>
            <div class="businessBoxButtonDescription">
               Teatr ognia, fontanna czekolady, pokazy laserowe
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