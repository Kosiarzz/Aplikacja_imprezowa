@extends('layouts.event')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center">
<div class="titlePage mb-3">
         Rezerwacje
      </div></div>
@foreach($reservations as $reservation)

    <div class="card col-12 mb-3 p-0">
        <div class="row no-gutters">
            <div class="col-md-4">
            <img src="{{$reservation->service->business->photos->first()->path}}" class="card-img" alt="zdjęcie">
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <a href="#"><h5 class="card-title">{{$reservation->service->business->title}}</h5></a>
                    <h6 class="card-title">{{$reservation->service->business->name}}</h6>
                    <h6 class="card-title">
                    @foreach($reservation->service->business->contactable as $contact)
                        {{$contact->phone}}
                    @endforeach
                    </h6>
                    <h6 class="card-title">{{$reservation->service->business->city->name}}, {{$reservation->service->business->address->street}}</h6>
                </div>
            </div>

            <div class="col-md-4 ">
            <div class="card-body ">
                    <h6 class="card-title">Okres rezerwacji</h6>
                    <h5 class="card-title">
                    Od {{$reservation->date_from}} do {{$reservation->date_to}}
                    </h5>
                    <h6 class="card-title">Status rezerwacji</h6>
                    <h5 class="card-title">
                    {{$reservation->status}} Oczekiwanie na akceptacje
                    </h5>
                
                </div>
            </div>
            <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs position-absolute float-end">X</a>

        </div>
        
    </div>

@endforeach
  
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#reservation").addClass("active");
</script>
@endpush