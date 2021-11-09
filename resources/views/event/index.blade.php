@extends('layouts.event')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="indexBoxName col-md-12">
            <div class="indexBoxNameTitle">
                {{$event->name}}
                
            </div>
            <div class="indexBoxNameDays">
                <span class="indexBoxNameDaysNumber">50</span> dni
            </div>
            <div class="indexBoxNameDate">
                {{$event->date_event}}
            </div>

        </div>
        
    
       
        <a href="{{ route('event.tasks') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                50%
                <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
            </div>
            <div class="indexBoxTasksName">
                Postęp przygotowań
            </div>
        </a>
        <a href="{{ route('event.finances') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                    50%
                    <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
            </div>
            <div class="indexBoxTasksName">
                Wykorzystanie budrzetu
            </div>
        </a>

        <a href="{{ route('event.guest') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
                50%
                <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
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
