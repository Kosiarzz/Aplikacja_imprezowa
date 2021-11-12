@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
    <h2 class="sub-header">Statystyki</h2>
    <div id="chart" style="height: 500px; width: 100%;"></div>
    <div style="height: 14px; width:30px; background:#5c7bd9; margin-right:5px; margin-left:20px;"></div> Wyświetlenia
    <div style="height: 14px; width:30px; background:#91cc75; margin-right:5px; margin-left:20px;"></div> Polubienia
    <div style="height: 14px; width:30px; background:#fac858; margin-right:5px; margin-left:20px;"></div> Rezerwacje
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#stats").addClass("active");
</script>
@endpush