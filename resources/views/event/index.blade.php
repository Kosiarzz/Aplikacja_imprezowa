@extends('layouts.event')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="indexBoxName col-md-12">
            <div class="indexBoxNameTitle">
                {{$event->name}}
                
            </div>
            <div class="indexBoxNameDays">
                <span class="indexBoxNameDaysNumber">{{date_diff(date_create(date("Y-m-d")), date_create($event->date_event))->format('%a')}}</span> dni do wydarzenia
            </div>
            <div class="indexBoxNameDate">
                {{$event->date_event}}
                
            </div>

        </div>
       
        <a href="{{ route('event.tasks') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
            {{$tasks['percentageTasksCompleted']}}% | {{$tasks['numberTasksCompleted']}}/{{$tasks['numberAllTasks']}}
                <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: {{$tasks['percentageTasksCompleted']}}%" aria-valuenow="{{$tasks['percentageTasksCompleted']}}" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
            </div>
            <div class="indexBoxTasksName">
                Postęp przygotowań
            </div>
        </a>

        <a href="{{ route('event.finances') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
            {{$guests['percentageGuestsConfirmed']}}% | {{$guests['numberGuestsConfirmed']}}/{{$guests['numberAllGuests']}}
                    <div class="progress">
  <div class="progress-bar" role="progressbar" style="width: {{$guests['percentageGuestsConfirmed']}}%" aria-valuenow="{{$guests['percentageGuestsConfirmed']}}" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
            </div>
            <div class="indexBoxTasksName">
                Potwierdzeni goście
            </div>
        </a>
        <a href="{{ route('event.guest') }}" class="indexBoxTasks">
            <div class="indexBoxTasksNumber">
            {{$finances['percentageFinancesCompleted']}}% | {{$finances['numberFinancesCompleted']}}/{{$finances['numberAllFinances']}}
                <div class="progress">
  <div class="progress-bar" role="progressbar" style="width:  {{$finances['percentageFinancesCompleted']}}%" aria-valuenow=" {{$finances['percentageFinancesCompleted']}}" aria-valuemin="0" aria-valuemax="100">PASEK POSTĘPU</div>
</div>
            </div>
            <div class="indexBoxTasksName">
                Zadania budżet
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
