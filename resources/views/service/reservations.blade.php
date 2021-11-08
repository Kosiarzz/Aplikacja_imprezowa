@extends('layouts.service')

@section('content')
<div class="container">
    
<div id="calendar"></div>
<h2 class="sub-header">Rezerwacje</h2>
        
        @foreach( $business as $business )
            @foreach( $business->services as $r=>$service ) 
            @php ( $r++ ) 

                <h4 class="blue"> Usługa: {{ $service->title }}</h4>

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
                                            <th>Potwierdzenie</th>
                                            <th>Usunięcie</th>
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
                                                    <td class="reservationConfirm"><a href="{{ route('reservation.confirmReservation', ['id' => $reservation->id]) }}" class="btn btn-primary btn-xs">Potwierdź</a></td>
                                                    <td class="reservationDelete"><a href="{{ route('reservation.deleteReservation', ['id' => $reservation->id]) }}" class="btn btn-danger btn-xs">Odmów</a></td>
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
                                            <th>Usunięcie</th>
                                        </tr>
                                    </thead>
                                    @foreach( $service->reservations as $reservation )
                                        @if($reservation->status == 1)
                                            <tbody>
                                                <tr>
                                                    <td class="reservationDateFrom">{{$reservation->date_from}}</td>
                                                    <td class="reservationDateTo">{{$reservation->date_to}}</td>
                                                    <td class="reservationUser"><a target="_blank">{{ $reservation->user->contactable[0]->name ?? 'Brak danych'}} {{$reservation->user->contactable[0]->surname ?? ''}}</a></td>
                                                    <td class="reservationUserPhone">{{ $reservation->user->contactable[0]->phone ?? 'Brak'}}</td>
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


   $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calender',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            var title = prompt('Event Title:');

            if(title)
            {
                var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        type: 'add'
                    },
                    success:function(data)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                })
            }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:"/full-calender/action",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
        }
    });

});
</script>
@endpush