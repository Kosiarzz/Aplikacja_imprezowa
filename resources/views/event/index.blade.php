@extends('layouts.event')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="space40"></div>
        <div class="indexBoxName col-md-12">
            <div class="indexBoxNameTitle">
                {{$event->name}}     
            </div>
            <div class="indexBoxNameDays">
                <span class="indexBoxNameDaysNumber">{{date_diff(date_create(date("Y-m-d")), date_create($event->date_event))->format('%a')}}</span>
            </div>
            <div class="indexBoxNameCategory">
                dni do 
                @if($event->category->name == 'Wesele')
                Wesela
                @elseif($event->category->name == 'Urodziny')
                Urodzin
                @elseif($event->category->name == 'Komunie')
                Komuni
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
            <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color:#683cca;">
                <div class="progress-bar" role="progressbar" style="width: {{$tasks['percentageTasksCompleted']}}%; background-color: #fff;" aria-valuenow="{{$tasks['percentageTasksCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        </a>

        <a href="{{ route('event.guest') }}" class="indexBoxEvent guest-color">
        <div class="indexBoxEventName">
                Potwierdzeni goście
            </div>
            <div class="indexBoxEventNumber">
            {{$guests['numberGuestsConfirmed']}}/{{$guests['numberAllGuests']}}  |  {{$guests['percentageGuestsConfirmed']}}%

            </div>
            <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color:#683cca;">
  <div class="progress-bar" role="progressbar" style="width: {{$guests['percentageGuestsConfirmed']}}%; background-color: #fff;" aria-valuenow="{{$guests['percentageGuestsConfirmed']}}" aria-valuemin="0" aria-valuemax="100"></div>
</div>

        </a>
        <a href="{{ route('event.finances') }}" class="indexBoxEvent finance-color">
        <div class="indexBoxEventName">
                Zadania finanse
            </div>
            <div class="indexBoxEventNumber">
            {{$finances['numberFinancesCompleted']}}/{{$finances['numberAllFinances']}} | {{$finances['percentageFinancesCompleted']}}% 

            </div>
            <div class="progress" style="margin-bottom:20px; margin-left:10px; margin-right:10px; background-color:#683cca;">
  <div class="progress-bar" role="progressbar" style="width:  {{$finances['percentageFinancesCompleted']}}%; background-color: #fff;" aria-valuenow=" {{$finances['percentageFinancesCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
</div>

        </a>
        <a class="btn btn-danger mr-4" data-toggle="modal" data-target="#deleteModal">Usuń wydarzenie</a>
        
    </div>
</div>

<!-- delete event modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Export do PDF</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
                Wszystko nieodwracalnie zostanie usunięte.
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <a href="{{ route('event.delete') }}" class="btn btn-danger">Usuń wydarzenie</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#dashboard").addClass("active");
</script>
@endpush
