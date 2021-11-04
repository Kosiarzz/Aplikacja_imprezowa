@extends('layouts.business')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="row mt-5">
         <a href="{{route('businessProfile.profile', 'lokal')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Lokal
            </div>
            <div class="businessBoxButtonDescription">
               Lokal, dworek, sala
            </div>
         </a>
         <a href="{{route('businessProfile.profile', 'music')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Muzyka
            </div>
            <div class="businessBoxButtonDescription">
               Zespół muzyczny, DJ
            </div>
         </a>
         <a href="{{route('businessProfile.profile', 'photo')}}" class="text-decoration-none businessBoxButton">
            <div class="businessBoxButtonTitle">
               Fotograf
            </div>
            <div class="businessBoxButtonDescription">
               Kamerzysta, fotograf, dron
            </div>
         </a>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $( ".serviceBoxButton" ).hover(
        
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