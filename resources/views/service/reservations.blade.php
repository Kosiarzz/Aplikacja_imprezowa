@extends('layouts.service')

@section('content')
<div class="container mt-5">
    
<div id="calendar"></div>
<h2 class="sub-header">Rezerwacje</h2>
        
        @foreach( $business as $business )
            @foreach( $business->services as $r=>$service ) 
            @php ( $r++ ) 

                <h4 class="blue"> Oferta: {{ $service->title }}</h4>

                <div class="row">
                    <div class="col-md-3">
                        <div class="reservation_calendar{{$r}}"></div>
                    </div>

                        <div class="row col-md-12">
                        Rezerwacje niepotwierdzone
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data od</th>
                                            <th>Data do</th>
                                            <th>Rezerwujący</th>
                                            <th>Telefon</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach( $service->reservations as $reservation )
                                        @if($reservation->status == 0)
                                            <tbody>
                                                <tr>        
                                                    <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                                    <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                                    <td class="reservationUser"><a target="_blank">{{ $reservation->user->contactable[0]->name ?? 'Brak danych'}} {{$reservation->user->contactable[0]->surname ?? ''}}</a></td>
                                                    <td class="reservationUserPhone">{{ $reservation->user->contactable[0]->phone ?? 'Brak'}}</td>
                                                    <td class="reservationConfirm">
                                                        <a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a> 
                                                        <a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odmów</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div><br>

                        <div class="row col-md-12">
                        Rezerwacje potwierdzone
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data od</th>
                                            <th>Data do</th>
                                            <th>Rezerwujący</th>
                                            <th>Telefon</th>
                                            <th>Akcja</th>
                                        </tr>
                                    </thead>
                                    @foreach( $service->reservations as $reservation )
                                        @if($reservation->status == 1)
                                            <tbody>
                                                <tr>
                                                    <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                                    <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                                    <td class="reservationUser"><a target="_blank">{{ $reservation->event->user->contactable[0]->name ?? 'Brak danych'}} {{$reservation->event->user->contactable[0]->surname ?? ''}}</a></td>
                                                    <td class="reservationUserPhone">{{ $reservation->event->user->contactable[0]->phone ?? 'Brak'}}</td>
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
@push('script')
<script>


   $( "a" ).removeClass( "active" );
   $("#reservations").addClass("active");


</script>
@endpush