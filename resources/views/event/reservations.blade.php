@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage mb-3">
      Rezerwacje
   </div>
   <div class="container-fluid">
      @foreach($reservations as $reservation)
      <div class="row groupList p-1 mb-3">
         <div class="col-md-4 p-0">
            @if($reservation->service->business->photos->isEmpty())
            <img src="{{asset('storage/photos/test.png')}}" class="card-img" alt="zdjęcie">
            @else
            <img src="{{asset('storage/'.$reservation->service->business->photos->first()->path)}}" class="card-img" alt="zdjęcie">
            @endif
         </div>
         <div class="col-md-8">
            <div class="row">
               <div class="col-md-12 text-center p-2" style="font-size:20px;">
                  {{$reservation->name_user}}
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 pl-3">
                  <a href="{{ route('businessDetails', ['id' => $reservation->service->business_id])}}">
                     <h5 class="card-title">{{$reservation->service->business->title}}</h5>
                  </a>
                  <h4 class="card-title">{{$reservation->service->business->name}}</h4>
                  <h6 class="card-title phone">
                     @foreach($reservation->service->business->contactable as $contact)
                        {{$contact->phone}}
                     @endforeach
                  </h6>
                  <h6 class="card-title">{{$reservation->service->business->city->name}}, {{$reservation->service->business->address->street}}</h6>
               </div>
               <div class="col-md-6">
                     @if($reservation->date_from == $reservation->date_to)
                        <h6 class="card-title">Data rezerwacji</h6>
                        <h5 class="card-title">
                        {{$reservation->date_from}}
                     @else
                        <h6 class="card-title">Okres rezerwacji</h6>
                        <h5 class="card-title">
                        Od {{$reservation->date_from}} do {{$reservation->date_to}}
                     @endif
                  </h5>
                  <h6 class="card-title">Status rezerwacji</h6>
                  <h5 class="card-title">
                     {{$reservation->status}}
                  </h5>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger">Anuluj rezerwację</a>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection

@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#reservation").addClass("active");

   var phone = document.getElementsByClassName("phone");
   
   for(var i = 0; i < phone.length; i++) {
   
      result = numberWithSpaces(phone[i].innerText);
      document.getElementsByClassName("phone")[i].innerText = result;
   }
   
   function numberWithSpaces(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
   }
</script>
@endpush