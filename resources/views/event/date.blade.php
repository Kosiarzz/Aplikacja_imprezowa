@extends('layouts.event')

@section('content')
<div class="container">
    <div class="space"></div>
    <div id="calendar" class="calendar"></div>
</div>
@endsection

@push('script')
<script>
        
    $(document).ready(function () {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
            dayNamesShort: ['Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela'],
            editable:false,
            header:{
                left:'title',
                right:'today, prev, next'
            },
            events:'{{url("/")}}/uzytkownik/wydarzenie/daty/kalendarz',
            selectable: false,
            selectHelper: false,
            editable:false,
            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:'{{url("/")}}/full-calender/action',
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
        });

        $(this).find(".fc-today-button").text("Dziś");
    });


    $( "a" ).removeClass( "active" );
    $("#date").addClass("active");
</script>
@endpush