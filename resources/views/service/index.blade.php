@extends('layouts.service')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center"> 
        <a href="{{ route('service.reservations') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                5
            </div>
            <div class="indexBoxTasksName">
                Oczekujących rezerwacji
            </div>
        </a>
        <a href="{{ route('service.notifications') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                10 
            </div>
            <div class="indexBoxTasksName">
                Nowych powiadomień
            </div>
        </a>

        <a href="{{ route('service.stats') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                23
            </div>
            <div class="indexBoxTasksName">
                Wyświetlenia
            </div>
        </a>

        <a href="{{ route('service.stats') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                5
            </div>
            <div class="indexBoxTasksName">
                Dodań do ulubionych
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