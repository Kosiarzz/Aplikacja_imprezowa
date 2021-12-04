@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="titlePage mb-3 col-12">
        Oferta {{$title}}
    </div>

    <div class="titlePage mb-3 col-12" style="text-align:center;">
        Wyszukaj rezerwację
    </div>
    <form method="post" action="{{route('service.reservationDetailsFilters')}}" class="form-inline groupList p-4" style="margin-bottom:30px;">
        {{csrf_field()}}    
        <div class="row col-12 justify-content-center">
            <div class="form-group mr-2">
                <label class="sr-only" for="date_from">Data od</label>
                <input id="date_from" name="date_from" type="date" value="{{old('date_from')}}" class="form-control">
            </div>
            <div class="form-group mr-2">
                <label class="sr-only" for="date_to">Data do</label>
                <input id="date_to" name="date_to" type="date" value="{{old('date_to')}}" class="form-control">
            </div>

            <div class="form-group mr-2">
                <input id="name" name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Imie">
            </div>

            <div class="form-group mr-2">
                <input id="surname" name="surname" type="text" value="{{old('surname')}}" class="form-control" placeholder="Nazwisko">
            </div>
        </div>
        <div class="row col-12 justify-content-center mt-2">
            <div class="form-check mr-3">
                <input class="form-check-input" type="checkbox" value="Oczekiwanie na akceptację" name="status[]" id="status1">
                <label class="form-check-label" for="status1">
                    Oczekujące na akceptację
                </label>
            </div>

            <div class="form-check mr-3">
                <input class="form-check-input" type="checkbox" value="Rezerwacja zaakceptowana" name="status[]" id="status2">
                <label class="form-check-label" for="status2">
                    Potwierdzone
                </label>
            </div>

            <div class="form-check mr-3">
                <input class="form-check-input" type="checkbox" value="Rezerwacja odrzucona" name="status[]" id="status3">
                <label class="form-check-label" for="status3">
                    Odrzucone
                </label>
            </div>

            <div class="form-check mr-3">
                <input class="form-check-input" type="checkbox" value="Rezerwacja anulowana" name="status[]" id="status4">
                <label class="form-check-label" for="status4">
                    Anulowane
                </label>
            </div>
        </div>
        <input type="hidden" name="serviceId" value="{{$id}}">
        <input type="hidden" name="serviceTitle" value="{{$title}}">
        <div class="row col-12 justify-content-center">
            <button type="submit" class="btn btn-info">Szukaj</button>
        </div>
    </form>

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
                                @if($reservation->status == 'Oczekiwanie na akceptację')
                                    <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a> 
                                    <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odmów</a>
                                @elseif($reservation->status == 'Rezerwacja zaakceptowana')
                                    <a href="{{ route('reservation.cancelReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Anuluj</a>
                                @elseif($reservation->status == 'Rezerwacja odrzucona')
                                    <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a> 
                                @elseif($reservation->status == 'Rezerwacja anulowana')
                                    <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a> 
                                @endif
                            </td>
                        </tr>
                    </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
   $("a").removeClass("active");
   $("#reservations").addClass("active");
</script>
@endpush