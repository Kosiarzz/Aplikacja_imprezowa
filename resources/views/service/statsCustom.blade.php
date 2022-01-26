@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-3">
        <div class="row col-12 m-0 p-0 groupList mb-3 p-3 mt-3" style="display:flex; justify-content:center;">
            <a href="{{route('service.stats')}}" class="statsButton mr-3">Statystyki usługi</a>
            <a href="{{route('service.statsOffers')}}" class="statsButton mr-3 ">Statystyki ofert</a>
            <a href="{{route('service.statsCustom')}}" class="statsButton mr-3 statsButtonActive">Niestandardowe statystyki</a>
        </div>


        <div id="businessStats" class="row col-12 groupList p-0 m-0 mb-4 pb-4" @if(isset($statsService))style="display:none;"@endif>
            <div class="row col-12 m-0 p-0 mb-3 pl-2 py-3 border-bottom"  style="display:flex; justify-content:center;">
                <a class="statsButton mr-3 businessButtonStats statsButtonActive">Statystyki usługi</a>
                <a class="statsButton mr-3 serviceButtonStats">Statystyki oferty</a>
            </div>
            <form class="row col-12 filter" method="GET" action="{{ route('service.statsCustomBusiness') }}" enctype="multipart/form-data">
            @csrf
                <i class="far fa-calendar-alt ml-3" style="font-size:24px; margin-top:3px;"></i>

                <div class="ml-2 mr-2">
                <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_from" @if(isset($request)) value="{{$request->date_from}}" @endif>
                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                -
                <div class="ml-2 mr-4">
                <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_to" @if(isset($request)) value="{{$request->date_to}}" @endif>
                @error('date')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
            
                <button class="btn btn-primary filter-button">Generuj</button>
                
            </form>
            </div>


    <div id="serviceStats" class="row col-12 groupList p-0 m-0 mb-4 pb-4" @if(isset($statsBusiness) || !isset($statsService))style="display:none;"@endif>
        <div class="row col-12 m-0 p-0 mb-3 pl-2 py-3 border-bottom"  style="display:flex; justify-content:center;">
            <a class="statsButton mr-3 businessButtonStats">Statystyki usługi</a>
            <a class="statsButton mr-3 serviceButtonStats statsButtonActive">Statystyki oferty</a>
        </div>
        <form class="row col-12 filter" method="GET" action="{{ route('service.statsCustomService') }}" enctype="multipart/form-data">
        @csrf
            <i class="far fa-calendar-alt ml-3" style="font-size:24px; margin-top:3px;"></i>

            <div class="ml-2 mr-2">
            <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_from" @if(isset($request)) value="{{$request->date_from}}" @endif>
            @error('date')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            -
            <div class="ml-2 mr-4">
            <input id="date" type="date" class="form-control date-filter @error('date') is-invalid @enderror" name="date_to" @if(isset($request)) value="{{$request->date_to}}" @endif>
            @error('date')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <i class="fas fa-shopping-cart" style="font-size:22px; margin-top:5px;"></i>
            <div class="mr-4">
            <select class="form-control filter-input ml-2" id="select" name="service" style="width:250px;">
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->title}}</option>
                @endforeach
            </select>
            </div>

            <button class="btn btn-primary filter-button">Generuj</button>
        </form>
    </div>


    @if(isset($statsBusiness))
        @if($statsBusiness->isEmpty())
            <div class="col-12 text-center mt-2 mb-1 titlePage">Statystyki</div>
            <div class="col-12 text-center mb-4 titlePage">{{date('d.m.Y', strtotime($request->date_from))}} - {{date('d.m.Y', strtotime($request->date_to))}}</div>
            <div class="col-12 text-center mt-2 mb-5 titlePage">Brak danych</div>
        @else
        <div class="row col-12 justify-content-center">
            <div class="col-12 text-center mt-2 mb-1 titlePage">Statystyki</div>
            <div class="col-12 text-center mb-4 titlePage">{{date('d.m.Y', strtotime($request->date_from))}} - {{date('d.m.Y', strtotime($request->date_to))}}</div>

            <div class="col-12 text-center mt-2 mb-1 titlePage">Suma wyświetleń, polubień i rezerwacji</div>
            <div class="businessBox">
                <div class="businessBoxIcon">
                    <i class="fas fa-eye" style="color:#5c7bd9;"></i>
                </div>
                <div class="businessBoxRight">
                    <div class="businessBoxNubmer" style="color:#5c7bd9;">
                        @if($statsBusiness->isEmpty())
                            0
                        @else
                            {{$statsBusiness->sum('views')}}
                        @endif
                    </div>
                    <div class="businessBoxText">
                        Wyświetlenia
                    </div>
                </div>
            </div>

            <div class="businessBox mb-5">
                <div class="businessBoxIcon">
                    <i class="fas fa-heart" style="color:#91cc75;"></i>
                </div>
                <div class="businessBoxRight">
                    <div class="businessBoxNubmer" style="color:#91cc75;">
                        @if($statsBusiness->isEmpty())
                            0
                        @else
                            {{$statsBusiness->sum('likes')}}
                        @endif
                    </div>
                    <div class="businessBoxText">
                        Polubienia
                    </div>
                </div>
            </div>

            
            <div class="businessBox">
                <div class="businessBoxIcon">
                    <i class="fas fa-address-card" style="color:#fac858;"></i>
                </div>
                <div class="businessBoxRight">
                    <div class="businessBoxNubmer" style="color:#fac858;">
                        @if($statsBusiness->isEmpty())
                            0
                        @else
                            {{$statsBusiness->sum('reservations')}}
                        @endif
                    </div>
                    <div class="businessBoxText">
                        Rezerwacje
                    </div>
                </div>
            </div>
        
        </div>
        @endif
    @endif

    @if(isset($statsService))
        @if($statsService->isEmpty())
            <div class="col-12 text-center mt-2 mb-1 titlePage">Statystyki</div>
            <div class="col-12 text-center mb-4 titlePage">{{date('d.m.Y', strtotime($request->date_from))}} - {{date('d.m.Y', strtotime($request->date_to))}}</div>
            <div class="col-12 text-center mt-2 mb-5 titlePage">Brak danych</div>
        @else
        <div class="row col-12 justify-content-center">
            <div class="col-12 text-center mt-2 mb-1 titlePage">Statystyki</div>
            <div class="col-12 text-center mb-4 titlePage">{{date('d.m.Y', strtotime($request->date_from))}} - {{date('d.m.Y', strtotime($request->date_to))}}</div>
            <div class="col-12 text-center mt-2 mb-2 titlePage">Suma wyświetleń i rezerwacji</div>
            <div class="businessStatsOfferBox mb-3">
                <div class="row p-0 m-0 pt-3 pb-3 col-12 businessStatsOfferBoxText">
                    {{$statsService[0]->title}}
                </div>
                <div class="row p-0 m-0 col-12 border-top businessStatsOfferBoxStats">
                    <div class="col-6 pt-2 border-right businessStatsOfferBoxStatsBox">
                        <i class="fas fa-eye" style="color:#5c7bd9;"></i>
                        <div class="businessStatsOfferBoxNumber">
                            @if($statsService[0]->statistic->isEmpty())
                                0
                            @else
                                {{$statsService[0]->statistic->sum('views')}}
                            @endif
                        </div>
                    </div>
                    <div class="col-6 pt-2 businessStatsOfferBoxStatsBox">
                        <i class="fas fa-address-card" style="color:#fac858;"></i>
                        <div class="businessStatsOfferBoxNumber p-0 m-0">
                            @if($statsService[0]->statistic->isEmpty())
                                0
                            @else
                                {{$statsService[0]->statistic->sum('reservations')}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif

    <div class="titlePage mb-3">Wykresy</div>
    <div id="chart" class="groupList mb-3" style="height: 500px; width: 100%;"></div>
    <div style="height: 14px; width:30px; background:#5c7bd9; margin-right:5px; margin-left:20px;"></div> Wyświetlenia
    <div style="height: 14px; width:30px; background:#91cc75; margin-right:5px; margin-left:20px;"></div> Polubienia
    <div style="height: 14px; width:30px; background:#fac858; margin-right:5px; margin-left:20px;"></div> Rezerwacje

</div>
</div>
@endsection
@push('script')
<script>
    $("a").removeClass("active");
    $("#stats").addClass("active");

    $( ".businessButtonStats" ).click(function() {
        $( "#serviceStats" ).hide();
        $( "#businessStats" ).show();
    });

    $( ".serviceButtonStats" ).click(function() {
        $( "#serviceStats" ).show();
        $( "#businessStats" ).hide();
    });
</script>
@endpush