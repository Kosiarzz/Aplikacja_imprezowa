@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <br>
           <a href="{{route('business.id',['id' => $room->business_id])}}">Powrót</a><br>
           <div style="width:100%;">
           
            {{$room->title}}<br>
            {{$room->description}}<br>
            {{$room->people_from}}<br>
            {{$room->people_to}}<br>
           </div>
           <br>Zdjęcia<br>
        <div class="mb-2" style="width:100%;">
           @foreach($room->photos as $photo)
           <img src="{{$photo->path ?? $defaultPhoto}}" class="mr-3 mb-3" width="219" height="121" alt="SALA">
           @endforeach
        </div>
        <br>
        <section id="reservation">

            <h3>Rezerwacja</h3>

            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('reservation.addReservation', ['room_id' => $room->id, 'city_id' => $room->business->city->id]) }}">
                        <div class="form-group">
                            <label for="dateFrom">Data od</label>
                            <input required name="dateFrom" type="text" class="form-control datepicker" id="dateFrom" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="dateTo">Data do</label>
                            <input required name="dateTo" type="text" class="form-control datepicker" id="dateTo" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary reservationBtn" data-id="{{$room->id}}">Rezerwacja</button> 
                        <p class="text-danger">
                            {{ Session::get('reservationMsg') }}
                        </p>
                        {{ csrf_field() }}
                    </form>
                </div><br>
                <div class="col-md-6">
                    <div id="avaiability_calendar"></div>
                </div>
            </div>
        </section>
    <!--
    
    -->
    </div>
</div>
@endsection
@push('calendar')
<script>

        function datesBetween(dateFrom, dateTo)
        {   
            var between = [];
            var startDate = new Date(dateFrom);
            var endDate = new Date(dateTo);

            while(startDate <= endDate)
            {
                between.push($.datepicker.formatDate('yy-mm-dd', new Date(startDate)));
                startDate.setDate(startDate.getDate()+1);
            }

            return between;
        }

        $.ajax({

        cache: false,
        url: base_url + '/ajaxGetRoomReservations/' + {{ $room->id }},
        type: "GET",
        success: function(response){



            var eventDates = {};
            var dates = [];
            for (var i = 0; i <= response.reservations.length - 1; i++)
            {
                dates.push( datesBetween(new Date(response.reservations[i].date_from), new Date(response.reservations[i].date_to)));
            }

            dates = [].concat.apply([],dates); //spłaszczenie tablicy

            for (var i = 0; i <= dates.length - 1; i++)
            {
                eventDates[dates[i]] = dates[i]; 
            }

            $(function () {
                $("#avaiability_calendar").datepicker({
                    onSelect: function (data) {

            //            console.log($('#dateFrom').val());

                        if ($('#dateFrom').val() == '')
                        {
                            $('#dateFrom').val(data);
                        } else if ($('#dateTo').val() == '')
                        {
                            $('#dateTo').val(data);
                        } else if ($('#dateTo').val() != '')
                        {
                            $('#dateFrom').val(data);
                            $('#dateTo').val('');
                        }

                    },
                    beforeShowDay: function (date)
                    {
                        var tmp = eventDates[$.datepicker.formatDate('yy-mm-dd', date)];
                        if (tmp)
                            return [false, 'unavaiable_date'];
                        else
                            return [true, ''];
                    }
                });
            });
        }

        });
 </script>
@endpush
