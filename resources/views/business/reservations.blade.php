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
                                    <tbody>
                                        <tr>
                                            <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                            <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                            <td class="reservationUser"><a target="_blank">Imie i nazwisko</a></td>
                                            <td class="reservationUserPhone">111 222 333</td>
                                            <td class="reservationConfirm"><a href="#" class="btn btn-primary btn-xs">Potwierdź</a></td>
                                            <td class="reservationDelete"><a href="#" class="btn btn-danger btn-xs">Odmów</a></td>
                                        </tr>
                                    </tbody>
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
