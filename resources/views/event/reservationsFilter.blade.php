@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage mb-3">
      Rezerwacje
   </div>
   <div class="row col-12 groupList p-0 m-0 mb-4">
      <div class="row col-12 filter-title m-0 p-0 mb-3 pl-2">
         Filtry
      </div>
         <form class="row col-12 filter" method="GET" action="{{ route('event.reservation.filter') }}" enctype="multipart/form-data">
         @csrf
            <i class="far fa-calendar-alt ml-3" style="font-size:24px; margin-top:3px;"></i>

            <div class="ml-2 mr-2">
               <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="dateFrom" value="{{$request->dateFrom}}">
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            -
            <div class="ml-2 mr-4">
               <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="dateTo" value="{{$request->dateTo}}">
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <i class="fas fa-check" style="font-size:22px; margin-top:5px;"></i>
            <div class="mr-4">
               <select class="form-control filter-input ml-2" id="select" name="status">
                  <option value="Oczekiwanie na akceptację" @if($request->status == "Oczekiwanie na akceptację") selected @endif>Oczekujące rezerwacje</option>
                  <option value="Rezerwacja zaakcepotwana" @if($request->status == "Rezerwacja zaakcepotwana") selected @endif>Zaakceptowane rezerwacje</option>
                  <option value="Rezerwacja odrzucona" @if($request->status == "Rezerwacja odrzucona") selected @endif>Odrzucone rezerwacje</option>
                  <option value="Rezerwacja anulowana" @if($request->status == "Rezerwacja anulowana") selected @endif>Anulowane rezerwacje</option>
               </select>
            </div>

            <i class="fas fa-map-marker-alt" style="font-size:22px; margin-top:5px;"></i>
            <div class="ml-2 mr-4">
               <input id="city" type="text" maxlength="100" class="form-control filter-input @error('city') is-invalid @enderror" name="city" placeholder="Miasto" value="{{$request->city}}">
               @error('city')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
               @enderror
            </div>
            <div class="row p-0 m-0 mt-3 mb-3">
               <i class="fas fa-tag ml-3" style="font-size:22px; margin-top:5px;"></i>
               <div class="ml-2 mr-4">
                  <input id="service" type="text" maxlength="100" class="form-control filter-input @error('service') is-invalid @enderror" name="service" placeholder="Typ usługi" value="{{$request->service}}">
                  @error('service')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <i class="far fa-building ml-2" style="font-size:24px; margin-top:4px;"></i>
               <div class="ml-2 mr-4">
                  <input id="business" type="text" maxlength="100" class="form-control filter-input @error('business') is-invalid @enderror" name="business" placeholder="Nazwa firmy" value="{{$request->business}}">
                  @error('business')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <button class="btn btn-primary filter-button">Szukaj</button>
            </div>
         </form>
   </div>
   <div class="container-fluid">
      @if($reservations->isEmpty())
         <div class="reservation-empty">
            Brak rezerwacji
         </div>
      @endif
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
                     <h5 class="card-title">{{str_limit($reservation->service->business->title,25)}}</h5>
                  </a>
                  <h5 class="card-title">{{$reservation->service->business->name}}</h5>
                  <div class="mb-1">
                     @foreach($reservation->service->business->contactable as $contact)
                     <i class="fas fa-phone-alt" style="font-size:17px;"></i> <span class="phone">{{$contact->phone}}</span>
                     @endforeach
                  </div>
                  <div class=""><i class="fas fa-map-marker-alt mr-2"></i>{{$reservation->service->business->city->name}}, {{$reservation->service->business->address->street}}</div>
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
            @if($reservation->status == "Oczekiwanie na akceptację")
            <div class="row">
               <div class="col-md-12 text-center">
                  <a href="{{ route('reservation.cancelReservation', ['id' => $reservation->id]) }}" class="btn btn-danger">Anuluj rezerwację</a>
               </div>
            </div>
            @endif
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