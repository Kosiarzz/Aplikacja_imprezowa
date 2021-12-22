@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="titlePage mb-3 col-12">
        Rezerwacje oferty {{$title}}
    </div>

    <div class="titlePage mb-3 col-12" style="text-align:center;">
        Wyszukaj rezerwację                                             
    </div>
    <form method="get" action="{{route('service.reservationDetailsFilters')}}" class="form-inline groupList p-4" style="margin-bottom:30px;">
        <div class="row col-12 justify-content-center">
            <div class="row col-12 justify-content-center mb-3">
                <div class="form-group mr-2">
                    <label for="date_from">Data od</label>
                    <input id="date_from" name="date_from" type="date" value="{{old('date_from')}}" class="form-control ml-2">
                </div>
                <div class="form-group mr-2">
                    <label for="date_to">Data do</label>
                    <input id="date_to" name="date_to" type="date" value="{{old('date_to')}}" class="form-control ml-2">
                </div>
            </div>
            <div class="form-group mr-2">
                <input id="name" name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Imie">
            </div>

            <div class="form-group mr-2">
                <input id="surname" name="surname" type="text" value="{{old('surname')}}" class="form-control" placeholder="Nazwisko">
            </div>

            <div class="form-group mr-2">
                <input id="surname" name="surname" type="text" value="{{old('surname')}}" class="form-control" placeholder="Nr telefonu">
            </div>
        </div>
        <div class="row col-12 justify-content-center mt-3">
            <div class="form-check mr-3">
                @if(!is_null($request) && $request->status == "Rezerwacja zaakceptowana")
                    <input class="form-check-input" type="radio" value="Oczekiwanie na akceptację" name="status" id="status1" checked>
                @else
                    <input class="form-check-input" type="radio" value="Oczekiwanie na akceptację" name="status" id="status1" checked>
                @endif
                <label class="form-check-label" for="status1">
                    Oczekujące na akceptację
                </label>
            </div>

            <div class="form-check mr-3">
                @if(!is_null($request) && $request->status == "Rezerwacja zaakceptowana")
                    <input class="form-check-input" type="radio" value="Rezerwacja zaakceptowana" name="status" id="status2" checked>
                @else
                    <input class="form-check-input" type="radio" value="Rezerwacja zaakceptowana" name="status" id="status2">
                @endif
                <label class="form-check-label" for="status2">
                    Zaakceptowane
                </label>
            </div>

            <div class="form-check mr-3">
                @if(!is_null($request) && $request->status == "Rezerwacja odrzucona")
                    <input class="form-check-input" type="radio" value="Rezerwacja odrzucona" name="status" id="status3" checked>
                @else
                    <input class="form-check-input" type="radio" value="Rezerwacja odrzucona" name="status" id="status3">
                @endif
                <label class="form-check-label" for="status3">
                    Odrzucone
                </label>
            </div>

            <div class="form-check mr-3">
                @if(!is_null($request) && $request->status == "Rezerwacja anulowana")
                    <input class="form-check-input" type="radio" value="Rezerwacja anulowana" name="status" id="status4" checked>
                @else
                    <input class="form-check-input" type="radio" value="Rezerwacja anulowana" name="status" id="status4">
                @endif
                <label class="form-check-label" for="status4">
                    Anulowane
                </label>
            </div>
        </div>
        <input type="hidden" name="serviceId" value="{{$id}}">
        <input type="hidden" name="serviceTitle" value="{{$title}}">
        <div class="row col-12 justify-content-center mt-2">
            <button type="submit" class="btn btn-info mr-3">Szukaj</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReservation">Dodaj rezerwację</button>  
        </div>
    </form>
    @if(!$reservations->isEmpty())
    <div class="table-responsive groupList p-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Data od</th>
                    <th>Data do</th>
                    <th>Rezerwujący</th>
                    <th>Telefon</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            
            
            
                @foreach($reservations as $reservation)
    
                        <tbody>
                            <tr>        
                                <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                <td class="reservationUser"><a target="_blank">{{ $reservation->event->user->contactable[0]->name ?? 'Brak danych'}} {{$reservation->event->user->contactable[0]->surname ?? ''}}</a></td>
                                <td class="reservationUserPhone">{{ $reservation->event->user->contactable[0]->phone ?? 'Brak'}}</td>
                                <td class="reservationUserPhone">{{ $reservation->status}}</td>
                                <td class="reservationConfirm">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#waitToAccept{{$reservation->id}}">Akcja</button>
                                    
                                </td>
                            </tr>
                        </tbody>
                        
                        <!--MODAL-->
                        <div class="modal fade" id="waitToAccept{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Rezerwacja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('addGroup') }}" class="row col-12">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-md-12 col-form-label">Imie</label>
                                                <div class="col-md-12">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $reservation->event->user->contactable[0]->name ?? 'Brak danych'}}" disabled>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="surname" class="col-md-12 col-form-label">Nazwisko</label>
                                                <div class="col-md-12">
                                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $reservation->event->user->contactable[0]->surname ?? 'Brak danych'}}" disabled>
                                                    @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-md-12 col-form-label">Numer telefonu</label>
                                                <div class="col-md-12">
                                                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $reservation->event->user->contactable[0]->phone ?? 'Brak'}}" disabled>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="dateFrom" class="col-md-12 col-form-label">Data od</label>
                                                <div class="col-md-12">
                                                    <input id="dateFrom" type="date" class="form-control @error('dateFrom') is-invalid @enderror" name="dateFrom" value="{{$reservation->date_from}}" required>
                                                    @error('dateFrom')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="dateTo" class="col-md-12 col-form-label">Data do</label>
                                                <div class="col-md-12">
                                                    <input id="dateTo" type="date" class="form-control @error('dateTo') is-invalid @enderror" name="dateTo" value="{{$reservation->date_to}}" required>
                                                    @error('dateTo')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="task" required>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="row col-12 justify-content-center">
                                                    @if($reservation->status == 'Oczekiwanie na akceptację')
                                                        <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs mr-5">Odmów rezerwację</a>
                                                        <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź rezerwację</a> 
                                                    @elseif($reservation->status == 'Rezerwacja zaakceptowana')
                                                        <a href="{{ route('reservation.cancelReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Anuluj rezerwację</a>
                                                    @elseif($reservation->status == 'Rezerwacja odrzucona')
                                                        <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź rezerwację</a> 
                                                    @elseif($reservation->status == 'Rezerwacja anulowana')
                                                        <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź rezerwację</a> 
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </table>
        @else
            <div class="row" style="text-align:center; font-size:24px; color:#656d79;">
                Brak rezerwacji
            </div>
        @endif
        @if($reservations->hasPages())
        {{$reservations->appends(Request::all())->links("pagination::bootstrap-4")}}
        @endif
        
 <!--MODAL-->
 <div class="modal fade" id="addReservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Nowa rezerwacja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('addGroup') }}" class="row col-12">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-12 col-form-label">Imie</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $reservation->event->user->contactable[0]->name ?? 'Brak danych'}}" required >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="surname" class="col-md-12 col-form-label">Nazwisko</label>
                        <div class="col-md-12">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $reservation->event->user->contactable[0]->surname ?? 'Brak danych'}}" required>
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-12 col-form-label">Numer telefonu</label>
                        <div class="col-md-12">
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $reservation->event->user->contactable[0]->phone ?? 'Brak'}}" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateFrom" class="col-md-12 col-form-label">Data od</label>
                        <div class="col-md-12">
                            <input id="dateFrom" type="date" class="form-control @error('dateFrom') is-invalid @enderror" name="dateFrom" value="{{$reservation->date_from ?? 'Brak'}}" required>
                            @error('dateFrom')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateTo" class="col-md-12 col-form-label">Data do</label>
                        <div class="col-md-12">
                            <input id="dateTo" type="date" class="form-control @error('dateTo') is-invalid @enderror" name="dateTo" value="{{$reservation->date_to ?? 'Brak'}}" required>
                            @error('dateTo')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="task" required>
                    </div>
                    <div class="modal-footer">  
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dodaj rezerwację</button>
                </form>
            </div>
        </div>
    </div>
</div>


    </div>
</div>
    


@endsection

@push('script')
<script>
   $("a").removeClass("active");
   $("#reservations").addClass("active");
</script>
@endpush