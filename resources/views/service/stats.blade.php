@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mb-3">
        <div class="row col-12 justify-content-center">
        <div class="col-12 text-center mt-2 mb-4 titlePage">Dzisiejsze statystyki</div>
        <div class="businessBox">
            <div class="businessBoxIcon">
                <i class="fas fa-eye" style="color:#5c7bd9;"></i>
            </div>
            <div class="businessBoxRight">
                <div class="businessBoxNubmer" style="color:#5c7bd9;">
                    {{$stats->views}}
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
                    {{$stats->likes}}
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
                    {{$stats->reservations}}
                </div>
                <div class="businessBoxText">
                    Rezerwacje
                </div>
            </div>
        </div>
    
    </div>
    <div class="titlePage mb-3">Ostatnie 7 dni</div>
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
</script>
@endpush