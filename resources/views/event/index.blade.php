@extends('layouts.event')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="indexBoxName col-md-12">
            <div class="indexBoxNameTitle">
                {{$events->name}}
            </div>
            <div class="indexBoxNameDays">
                <span class="indexBoxNameDaysNumber">50</span> dni
            </div>
            <div class="indexBoxNameDate">
                {{$events->date_event}}
            </div>

        </div>
        
       
       
        <a href="{{ route('event.tasks') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                50%
            </div>
            <div class="indexBoxTasksName">
                Postęp przygotowań
            </div>
        </a>
        <a href="{{ route('event.finances') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                    50%
            </div>
            <div class="indexBoxTasksName">
                Wykorzystanie budrzetu
            </div>
        </a>

        <a href="{{ route('event.guest') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                50%
            </div>
            <div class="indexBoxTasksName">
                Potwierdzeni goście
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
