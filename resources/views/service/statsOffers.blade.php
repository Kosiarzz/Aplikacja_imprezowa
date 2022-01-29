@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-3">
            <div class="row col-12 m-0 p-0 groupList mb-3 p-3" style="display:flex; justify-content:center;">
                <a href="{{route('service.stats')}}" class="statsButton mr-3">Statystyki usługi</a>
                <a href="{{route('service.statsOffers')}}" class="statsButton mr-3 statsButtonActive">Statystyki ofert</a>
                <a href="{{route('service.statsCustom')}}" class="statsButton mr-3 ">Niestandardowe statystyki</a>
            </div>
            <div class="row col-12 justify-content-center">
                <div class="col-12 text-center mt-2 mb-4 titlePage">Dzisiejsze statystyki</div>
                @foreach($stats as $stat)
                    <div class="businessStatsOfferBox mb-3">
                        <div class="row p-0 m-0 pt-3 pb-3 col-12 businessStatsOfferBoxText">
                            {{$stat->title}}
                        </div>
                        <div class="row p-0 m-0 col-12 border-top businessStatsOfferBoxStats">
                            <div class="col-6 pt-2 border-right businessStatsOfferBoxStatsBox">
                                <i class="fas fa-eye" style="color:#5c7bd9;"></i>
                                <div class="businessStatsOfferBoxNumber">
                                    @if($stat->statistic->isEmpty())
                                        0
                                    @else
                                        {{$stat->statistic[0]->views}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 pt-2 businessStatsOfferBoxStatsBox">
                                <i class="fas fa-address-card" style="color:#fac858;"></i>
                                <div class="businessStatsOfferBoxNumber p-0 m-0">
                                    @if($stat->statistic->isEmpty())
                                        0
                                    @else
                                        {{$stat->statistic[0]->reservations}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        <div class="row col-12 justify-content-center">
        <div class="col-12 text-center mt-2 mb-4 titlePage">Ostatnie 7 dni</div>
            @foreach($moreStats as $mStat)
                    <div class="businessStatsOfferBox mb-3">
                        <div class="row p-0 m-0 pt-3 pb-3 col-12 businessStatsOfferBoxText">
                            {{$mStat->title}}
                        </div>
                        <div class="row p-0 m-0 col-12 border-top businessStatsOfferBoxStats">
                            <div class="col-6 pt-2 border-right businessStatsOfferBoxStatsBox">
                                <i class="fas fa-eye" style="color:#5c7bd9;"></i>
                                <div class="businessStatsOfferBoxNumber">
                                    @if($mStat->statistic->isEmpty())
                                        0
                                    @else
                                        {{$mStat->statistic->sum('views')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 pt-2 businessStatsOfferBoxStatsBox">
                                <i class="fas fa-address-card" style="color:#fac858;"></i>
                                <div class="businessStatsOfferBoxNumber p-0 m-0">
                                    @if($mStat->statistic->isEmpty())
                                        0
                                    @else
                                        {{$mStat->statistic->sum('reservations')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
   $("a").removeClass("active");
   $("#stats").addClass("active");

   $(".businessStatsOfferBoxText").each(function () {
        var numChars = $(this).text().length; 
        console.log(numChars);
        if ((numChars >= 80)) {
            $(this).css("font-size", "1.1em");
        }       
    });
</script>
@endpush