@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
           
           <div class="groupList row col-12 mb-3" style="">
           <!--<a href="{{route('businessDetails',['id' => $service->business_id])}}" class="mt-1"  style="font-size:16px;">Powrót</a>-->
         <div class="col-12 mb-4 pb-3 border-bottom" style="text-align:center; font-size:30px;">
            {{$service->title}}
         </div>
         <div class="row col-12 mt-0 pl-4 mb-5" style="font-size:18px; white-space: pre-line;">
            {{$service->description}}
         </div>
      </div>
      <div class="businessBox mb-5" style="width:30.4%;">
         <div class="businessBoxIcon">
            <i class="fas fa-users"></i>
         </div>
         <div class="businessBoxRight">
            <div class="businessBoxNubmer">
               @if($service->people_from == $service->people_to)
                  {{$service->people_from}}
               @else
                  od {{$service->people_from}}
                  do {{$service->people_to}} 
               @endif
            </div>
            <div class="businessBoxText">
            @if($service->business->name_category == 'room')
               osób
            @else
               osób w zespole
            @endif
            </div>
         </div>
      </div>
      <div class="businessBox mb-2" style="width:32.4%;">
         <div class="businessBoxIcon">
            <i class="fas fa-money-check-alt"></i>
         </div>
         <div class="businessBoxRight">
            <div class="businessBoxNubmer">
               @if($service->price_from == $service->price_to)
                  <span class="money">{{$service->price_from}}</span> zł
               @else
                  od <span class="money">{{$service->price_from}}</span> zł
                  do <span class="money">{{$service->price_to}}</span> zł
               @endif
            </div>
            <div class="businessBoxText">
               {{$service->unit}}
            </div>
         </div>
      </div>
      @if($service->business->name_category == 'room')
         <div class="businessBox mb-2" style="width:32.4%;">
            <div class="businessBoxIcon">
               <i class="fas fa-house-user"></i>
            </div>
            <div class="businessBoxRight">
               <div class="businessBoxNubmer">
                  {{$service->size}} m<sup>2</sup>
               </div>
               <div class="businessBoxText">
                  Wielkość
               </div>
            </div>
         </div>
      @endif
      <div class="row col-12 groupList p-4 mb-4">
          <div class="col-12 mb-4" style="text-align:center; font-size:22px;">Dokonaj rezerwacji</div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('reservation.addReservation', ['service_id' => $service->id, 'city_id' => $service->business->city->id, 'service_name' => $service->title]) }}">
                <div class="form-group">
                    <label for="dateFrom">Data od</label>
                    <input required name="dateFrom" type="text" class="form-control datepicker" id="dateFrom" placeholder="">
                </div>
                <div class="form-group">
                    <label for="dateTo">Data do</label>
                    <input required name="dateTo" type="text" class="form-control datepicker" id="dateTo" placeholder="">
                </div>
                @can('isUser')
                   @if(session('event'))
                        <button type="submit" class="btn btn-primary reservationBtn" data-id="{{$service->id}}">Zarezerwuj termin</button> 
                   @else
                        Wybierz wydarzenie dla którego chcesz dokonać rezerwacji.
                   @endif
                @else
                    Zaloguj się aby dokonać rezerwacji.
                @endcan
                
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
      @if(!$service->photos->isEmpty())
      <div class="row justify-content-center m-0 p-0 mt-1 groupList p-3">
         <div id="carouselExampleControls" class="carousel slide pl-1" data-ride="carousel">
            <div class="carousel-inner" style="width:900px; height:500px;">
               @php($i = 1)
               @foreach($service->photos as $photo)
                  @if($i == 1)
                     <div class="col-12 carousel-item active" style="width:900px; height:500px;">
                        <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                     </div>
                  @else
                     <div class="col-12 carousel-item" style="width:900px; height:500px;">
                        <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                     </div>
                  @endif   
                  @php($i++)
               @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
      @endif
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
        url: base_url + '/ajaxGetServiceReservations/' + {{ $service->id }},
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
                    dayNamesMin: [ "niedz", "pon", "wt", "śr", "czw", "pt", "sob" ],
                    monthNames: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ],
                    firstDay: 1,
                    prevText: "<",
                    nextText: ">",
                    onSelect: function (data) {
                        if ($('#dateFrom').val() == '')
                        {
                            $('#dateFrom').val(data);
                        } 
                        else if ($('#dateTo').val() == '')
                        {
                            $('#dateTo').val(data);
                        } 
                        else if ($('#dateTo').val() != '')
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
                    },
                });
            });
        }

        });

        var money = document.getElementsByClassName("money");
    
    for(var i = 0; i < money.length; i++) {
    
       result = numberWithSpaces(money[i].innerText);
       document.getElementsByClassName("money")[i].innerText = result;
    }
 
    function numberWithSpaces(x) {
       return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
     }
 </script>
@endpush
