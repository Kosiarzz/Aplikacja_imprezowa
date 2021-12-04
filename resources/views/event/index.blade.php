@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="space40"></div>
      <div class="indexBoxName col-md-12 p-0">
         <div class="indexBoxNameTitle">
            {{$event->name}}     
         </div>
         <div class="indexBoxNameDays">
            <span class="indexBoxNameDaysNumber">
            @if(($days = date_diff(date_create(date("Y-m-d")), date_create($event->date_event))->format('%a')) == 0)
               To już dzisiaj!
            @else
               {{$days}}
            @endif
            </span>
         </div>
         <div class="indexBoxNameCategory">
            @if($days > 0)
               dni do 
               @if($event->category->name == 'Wesele')
                  Wesela
               @elseif($event->category->name == 'Urodziny')
                  Urodzin
               @elseif($event->category->name == 'Komunia')
                  Komuni
               @endif
            @endif
         </div>
         <div class="indexBoxNameDate">
            {{$event->date_event}}
         </div>
      </div>
      <a href="{{ route('event.tasks') }}" class="indexBoxEvent task-color">
         <div class="indexBoxEventName">
            Postęp przygotowań
         </div>
         <div class="indexBoxEventNumber">
            {{$tasks['numberTasksCompleted']}}/{{$tasks['numberAllTasks']}} | {{$tasks['percentageTasksCompleted']}}% 
         </div>
         <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color: #f8f8f7;">
            <div class="progress-bar" role="progressbar" style="width: {{$tasks['percentageTasksCompleted']}}%; background-color: #f1b505;" aria-valuenow="{{$tasks['percentageTasksCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
      </a>
      <a href="{{ route('event.guest') }}" class="indexBoxEvent guest-color">
         <div class="indexBoxEventName">
            Potwierdzeni goście
         </div>
         <div class="indexBoxEventNumber">
            {{$guests['numberGuestsConfirmed']}}/{{$guests['numberAllGuests']}}  |  {{$guests['percentageGuestsConfirmed']}}%
         </div>
         <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color:#ddd;">
            <div class="progress-bar" role="progressbar" style="width: {{$guests['percentageGuestsConfirmed']}}%; background-color: #683cca;" aria-valuenow="{{$guests['percentageGuestsConfirmed']}}" aria-valuemin="0" aria-valuemax="100"></div>
         </div>
      </a>
      <a href="{{ route('event.finances') }}" class="indexBoxEvent finance-color">
         <div class="indexBoxEventName">
            Zadania finanse
         </div>
         <div class="indexBoxEventNumber">
            {{$finances['numberFinancesCompleted']}}/{{$finances['numberAllFinances']}} | {{$finances['percentageFinancesCompleted']}}% 
         </div>
         <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color:#ddd;">
            <div class="progress-bar" role="progressbar" style="width:  {{$finances['percentageFinancesCompleted']}}%; background-color: #683cca;" aria-valuenow=" {{$finances['percentageFinancesCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
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