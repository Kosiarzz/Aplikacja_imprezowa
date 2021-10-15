@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
     
            

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Data od</th>
                        <th>Data do</th>
                        <th>Status</th>
                        <th>Usunięcie</th>
                    </tr>
                </thead>
                @foreach($reservations as $reservation)
                <tbody>
                    <tr>
                        <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                        <td class="reservationDateTo">{{$reservation->date_to}}</td>
                        <td class="reservationStatus">
                            @if($reservation->status == 0)
                                Oczekiwanie na akceptacje
                            @else
                                Zaakceptowano
                            @endif

                        </td>
                        <td class="reservationDelete"><a href="{{ route('user.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Usuń</a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
    </div>
</div>
@endsection
