@extends('layouts.service')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center"> 

        <a href="{{ route('service.reservations') }}" class="indexBoxEvent task-color">
            <div class="indexBoxEventName">
            Oczekujących rezerwacji
            </div>
            <div class="indexBoxEventNumber">
            5
            </div>
        </a>

        <a href="{{ route('service.notifications') }}" class="indexBoxEvent">
            <div class="indexBoxEventName">
                Nowych powiadomień
            </div>
            <div class="indexBoxEventNumber">
                10 
            </div>
        </a>

        <a href="{{ route('service.stats') }}" class="indexBoxEvent">
            <div class="indexBoxEventName">
                Wyświetlenia
            </div>
            <div class="indexBoxEventNumber">
                10 
            </div>
        </a>

        <a href="{{ route('service.stats') }}" class="indexBoxEvent">
            <div class="indexBoxEventName">
                Dodań do ulubionych
            </div>
            <div class="indexBoxEventNumber">
                10 
            </div>
        </a>
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#dashboard").addClass("active");
</script>
@endpush