@extends('layouts.service')

@section('content')
<div class="container">
    <div class="space"></div>
    <div id="calendar"  class="calendar"></div>

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
    editable:true,
    header:{
        left:'title',
        right:'today, prev, next'
    },
    events:'{{url("/")}}/firma/usługa/daty/kalendarz',
    selectable:false,
    selectHelper: false,
    editable:false,
});


$(this).find(".fc-today-button").text("Dziś");
});


   $( "a" ).removeClass( "active" );
   $("#calendarMenu").addClass("active");
</script>
@endpush