@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <button style="width:140px; height:30px; font-size:12px; margin-right:15px;">Dodaj do ulubionych</button>
            <br>
           <a href="{{route('businessDetails',['id' => $room->business_id])}}">Powrót</a><br>
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
                    <form method="POST">
                        <div class="form-group">
                            <label for="checkin">Data od</label>
                            <input required name="checkin" type="text" class="form-control datepicker" id="checkin" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="checkout">Data do</label>
                            <input required name="checkout" type="text" class="form-control datepicker" id="checkout" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary reservationBtn" data-id="{{$room->id}}">Rezerwacja</button> 
                        <p class="text-danger">Jaikiś błąd</p>
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

    //            console.log($('#checkin').val());

                if ($('#checkin').val() == '')
                {
                    $('#checkin').val(data);
                } else if ($('#checkout').val() == '')
                {
                    $('#checkout').val(data);
                } else if ($('#checkout').val() != '')
                {
                    $('#checkin').val(data);
                    $('#checkout').val('');
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