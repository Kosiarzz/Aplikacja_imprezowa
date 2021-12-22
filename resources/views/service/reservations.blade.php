@extends('layouts.service')

@section('content')
<div class="container mt-5">
    
    <div class="titlePage mb-3 col-12">
        Lista ofert
    </div>
    <div class="row col-12">
        @foreach($services as $service)
            <a href="{{ route('service.reservationsDetails', ['id' => $service->id, 'title' => $service->title]) }}" class="indexBoxReservation" style="text-align:center;">
                <div class="indexBoxReservationName" style="min-height: 100px;">
                    {{$service->title}}
                </div>
                <div class="indexBoxReservationNumber" style="text-align:center;">
                    Oczekujących rezerwacji: {{count($service->reservations->where('status', 'Oczekiwanie na akceptację'))}}
                </div>
            </a>
        @endforeach
        </div>
</div>
@endsection
@push('script')
<script>


   $( "a" ).removeClass( "active" );
   $("#reservations").addClass("active");


</script>
@endpush