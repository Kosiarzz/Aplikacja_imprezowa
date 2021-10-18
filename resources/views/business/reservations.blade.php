@extends('layouts.app')

@section('content')
<div class="container">
   

    <h2 class="sub-header">Rezerwacje</h2>
    
        @foreach( $business as $business )
            @foreach( $business->rooms as $r=>$room ) 
            @php ( $r++ ) 

                <h4 class="blue"> Sala: {{ $room->title }}</h4>

                <div class="row top-buffer">
                    <div class="col-md-3">
                        <div class="reservation_calendar{{$r}}"></div>
                    </div>
                       
                        <div class="col-md-9">
                        Rezerwacje niepotwierdzone
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data od</th>
                                            <th>Data do</th>
                                            <th>Rezerwujący</th>
                                            <th>Telefon</th>
                                            <th>Potwierdzenie</th>
                                            <th>Usunięcie</th>
                                        </tr>
                                    </thead>
                                    @foreach( $room->reservations as $reservation )
                                        @if($reservation->status == 0)
                                            <tbody>
                                                <tr>
                                                    <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                                    <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                                    <td class="reservationUser"><a target="_blank">{{ $reservation->user->contact[0]->name ?? 'Brak danych'}} {{$reservation->user->contact[0]->surname ?? ''}}</a></td>
                                                    <td class="reservationUserPhone">{{ $reservation->user->contact[0]->phone ?? 'Brak'}}</td>
                                                    <td class="reservationConfirm"><a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a></td>
                                                    <td class="reservationDelete"><a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odmów</a></td>
                                                </tr>
                                            </tbody>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div><br>
                        
                        <div class="col-md-9">
                        Rezerwacje potwierdzone
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data od</th>
                                            <th>Data do</th>
                                            <th>Rezerwujący</th>
                                            <th>Telefon</th>
                                            <th>Potwierdzenie</th>
                                            <th>Usunięcie</th>
                                        </tr>
                                    </thead>
                                    @foreach( $room->reservations as $reservation )
                                        @if($reservation->status == 1)
                                            <tbody>
                                                <tr>
                                                    <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                                    <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                                    <td class="reservationUser"><a target="_blank">{{ $reservation->user->contact[0]->name ?? 'Brak danych'}} {{$reservation->user->contact[0]->surname ?? ''}}</a></td>
                                                    <td class="reservationUserPhone">{{ $reservation->user->contact[0]->phone ?? 'Brak'}}</td>
                                                    <td class="reservationConfirm"><a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a></td>
                                                    <td class="reservationDelete"><a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odmów</a></td>
                                                </tr>
                                            </tbody>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    
                </div>

                <hr>

            @endforeach

        @endforeach

</div>
@endsection
