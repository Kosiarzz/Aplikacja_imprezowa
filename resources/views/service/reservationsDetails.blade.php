@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="titlePage mb-3 col-12">
        Rezerwacje oferty {{$title}}
    </div>
    <div class="row col-12 groupList p-0 m-0 mb-4">
      <div class="row col-12 filter-title m-0 p-0 mb-3 pl-2">
         Filtry
      </div>
         <form class="row col-12 filter" method="GET" action="{{ route('service.reservationDetailsFilters') }}" enctype="multipart/form-data">
         @csrf
            <i class="far fa-calendar-alt ml-3" style="font-size:24px; margin-top:3px;"></i>

            <div class="ml-2 mr-2">
               <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_from" @if(isset($request)) value="{{$request->date_from}}" @endif>
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            -
            <div class="ml-2 mr-4">
               <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_to" @if(isset($request)) value="{{$request->date_to}}" @endif>
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <i class="fas fa-check" style="font-size:22px; margin-top:5px;"></i>
            <div class="mr-4">
               <select class="form-control filter-input ml-2" id="select" name="status">
                <option value="Oczekiwanie na akceptację" @if(isset($request) && $request->status == "Oczekiwanie na akceptację") selected @endif>Oczekujące rezerwacje</option>
                  <option value="Rezerwacja zaakceptowana" @if(isset($request) && $request->status == "Rezerwacja zaakceptowana") selected @endif>Zaakceptowane rezerwacje</option>
                  <option value="Rezerwacja odrzucona" @if(isset($request) && $request->status == "Rezerwacja odrzucona") selected @endif>Odrzucone rezerwacje</option>
                  <option value="Rezerwacja anulowana" @if(isset($request) && $request->status == "Rezerwacja anulowana") selected @endif>Anulowane rezerwacje</option>
               </select>
            </div>
            <div class="row p-0 m-0 mt-3 mb-3">
                <i class="fas fa-user ml-3" style="font-size:22px; margin-top:5px;"></i>
                <div class="ml-2">
                <input id="city" type="text" maxlength="100" class="form-control filter-input @error('city') is-invalid @enderror" name="name" placeholder="Imię" @if(isset($request)) value="{{$request->name}}" @endif>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
               <div class="ml-2 mr-4">
                  <input id="service" type="text" maxlength="100" class="form-control filter-input @error('service') is-invalid @enderror" name="surname" placeholder="Nazwisko" @if(isset($request)) value="{{$request->surname}}" @endif>
                  @error('service')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <i class="fas fa-phone ml-2" style="font-size:22px; margin-top:5px;"></i>
               <div class="ml-2 mr-4">
                  <input id="business" type="text" maxlength="100" class="form-control filter-input @error('business') is-invalid @enderror" name="phone" placeholder="Numer telefonu" @if(isset($request)) value="{{$request->phone}}" @endif>
                  @error('business')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <input type="hidden" name="serviceId" value="{{$id}}">
                <input type="hidden" name="serviceTitle" value="{{$title}}">
               <button class="btn btn-primary filter-button">Szukaj</button>
            </div>
         </form>
    </div>
    @if(!$reservations->isEmpty())
        @foreach($reservations as $reservation)
            <div class="row col-12 m-0 p-0 groupList mt-3">
                <div class="avatar-service">
                    @if(isset($reservation->event->user->photos))
                        <img src="{{asset('storage/'.$reservation->event->user->photos->path)}}" width="60" height="60" class="rounded-circle border mt-2" alt="avatar">
                    @else
                        <img src="{{asset('storage/default/defaultAvatar.png')}}" width="60" height="60" class="rounded-circle border mt-2" alt="avatar">
                    @endif
                </div>
                <div class="sReservation-user">
                    <div class="sReservation-name">
                    {{ $reservation->event->user->contactable[0]->name ?? 'Brak danych'}} {{$reservation->event->user->contactable[0]->surname ?? ''}}
                    </div>
                    <div class="sReservation-phone">
                    <i class="fas fa-phone" style="font-size:18px"></i> <span class="phone-number">{{ $reservation->event->user->contactable[0]->phone ?? 'Brak'}}</span>
                    </div>
                </div>
                <div class="sReservation-date-box">
                    <div class="sReservation-date-tittle">
                        Okres rezerwacji
                    </div>
                    <div class="sReservation-date">
                    {{date('d.m.Y', strtotime($reservation->date_from))}} {{date('d.m.Y', strtotime($reservation->date_from))}}
                    </div>
                </div>
                <div class="sReservation-status-box mr-2">
                    <div class="sReservation-status-tittle">
                        Status
                    </div>
                    <div class="sReservation-status">
                    {{ $reservation->status}}
                    </div>
                </div>
                <div class="sReservation-note border-left border-right">
                    {{str_limit($reservation->note, 45)}}
                </div>
                <div class="sReservation-action pl-2">
                    @if($reservation->status == "Oczekiwanie na akceptację")
                        <button class="btn btn-success btn-service-reservation" data-toggle="modal" data-target="#acceptModal{{$reservation->id}}" data-id="{{$reservation->id}}"><i class="fas fa-clipboard-check" style="font-size:16px"></i> Akceptuj</button>
                        <button class="btn btn-info btn-service-reservation" data-toggle="modal" data-target="#noteModal{{$reservation->id}}"><i class="fas fa-edit" style="font-size:16px"></i> Notatka</button>
                        <button class="btn btn-danger btn-service-reservation" data-toggle="modal" data-target="#cancelModal{{$reservation->id}}"><i class="fas fa-times" style="font-size:16px;"></i> Odrzuć</button> 
                    @elseif($reservation->status == "Rezerwacja zaakceptowana")
                        <button class="btn btn-info btn-service-reservation" data-toggle="modal" data-target="#noteModal{{$reservation->id}}"><i class="fas fa-edit" style="font-size:16px"></i> Notatka</button>
                        <button class="btn btn-danger btn-service-reservation" data-toggle="modal" data-target="#cancelModal2{{$reservation->id}}"><i class="fas fa-times" style="font-size:16px;"></i> Anuluj</button> 
                    @else
                        <button class="btn btn-info btn-service-reservation" data-toggle="modal" data-target="#noteModal{{$reservation->id}}"><i class="fas fa-edit" style="font-size:16px"></i> Notatka</button>
                    @endif
                </div>
            </div>


            <!-- Accept reservation modal -->
            <div class="modal fade" id="acceptModal{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="acceptModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title edit" id="acceptModal">Potwierdzenie rezerwacji</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Czy na pewno chcesz zaakceptować rezerwację?
                            <div class="modal-footer mt-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-success btn-xs">Potwierdź</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancel reservation modal -->
            <div class="modal fade" id="cancelModal{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title edit" id="cancelModal">Odrzucenie rezerwacji</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Czy na pewno chcesz odrzucić rezerwację?
                            <div class="modal-footer mt-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odrzuć</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancel2 reservation modal -->
            <div class="modal fade" id="cancelModal2{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="cancelModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title edit" id="cancelModal">Anulowanie rezerwacji</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Czy na pewno chcesz anulować rezerwację?
                            <div class="modal-footer mt-2">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Powrót</button>
                                <a href="{{ route('reservation.cancelReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Anuluj</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note reservation modal -->
            <div class="modal fade" id="noteModal{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="noteModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title edit" id="noteModal">Notatka</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('reservationSaveNote') }}">
                            @csrf
                                <textarea id="edit-note" name="note" maxlength="500" class="col-12" style="height:150px;">{{$reservation->note}}</textarea>
                                <input  type="hidden" name="id_reservation" value="{{$reservation->id}}" required>
                                <div class="modal-footer mt-2">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                    <button class="btn btn-primary btn-xs">Zapisz</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach  
    @else
    <div class="reservation-empty">
            Brak rezerwacji
         </div>
    @endif
</div>




@endsection

@push('script')
<script>
   $("a").removeClass("active");
   $("#reservations").addClass("active");

   var phone = document.getElementsByClassName("phone-number");
   
   for(var i = 0; i < phone.length; i++) {
   
      result = numberWithSpaces(phone[i].innerText);
      document.getElementsByClassName("phone-number")[i].innerText = result;
   }

   function numberWithSpaces(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
   }
</script>
@endpush