@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="row">
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
            @if(date_create(date("Y-m-d")) > date_create($event->date_event))
               dni temu
               @if($event->category->name == 'Wesele')
                  odbyło się wasze Wesele
               @elseif($event->category->name == 'Urodziny')
                  odbyły się twoje Urodziny
               @elseif($event->category->name == 'Komunia')
                  odbyła się twoja Komunia święta
               @endif  
            @elseif(date_create(date("Y-m-d")) < date_create($event->date_event))
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

      <div class="row p-0 m-0">
         <a href="{{ route('event.tasks') }}" class="indexBoxEvent task-color">
            <div class="indexBoxEventName">
               Zadania
            </div>
            <div class="indexBoxEventText">
               <div class="indexBoxEventNumberText">
                  Wykonanane zadania
               </div>
               <div class="indexBoxEventNumber indexBoxEventNumberGreen">
                  {{$tasks['numberTasksCompleted']}}/{{$tasks['numberAllTasks']}} 
               </div>
            </div>
            <div class="progressSize">
               <div class="progress">
                  <div class="progress-bar progress-bar-green" role="progressbar" style="width: {{$tasks['percentageTasksCompleted']}}%;" aria-valuenow="{{$tasks['percentageTasksCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
            <div class="percentageEvent">
            Ukończono <span class="indexBoxEventNumberGreen">{{$tasks['percentageTasksCompleted']}}% </span>
            </div>
         </a>

         <a href="{{ route('event.guest') }}" class="indexBoxEvent guest-color" style="margin-left:15px; margin-right:15px;">
            <div class="indexBoxEventName">
               Goście
            </div>
            <div class="indexBoxEventText">
               <div class="indexBoxEventNumberText">
                  Potwierdzeni goście
               </div>
               <div class="indexBoxEventNumber indexBoxEventNumberBlue">
                  {{$guests['numberGuestsConfirmed']}}/{{$guests['numberAllGuests']}}
               </div>
            </div>
            <div class="progressSize">
               <div class="progress">
                  <div class="progress-bar progress-bar-blue" role="progressbar" style="width: {{$guests['percentageGuestsConfirmed']}}%; background-color: #683cca;" aria-valuenow="{{$guests['percentageGuestsConfirmed']}}" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
            <div class="percentageEvent">
            Ukończono <span class="indexBoxEventNumberBlue">{{$guests['percentageGuestsConfirmed']}}%</span>
            </div>
         </a>

         <a href="{{ route('event.finances') }}" class="indexBoxEvent finance-color">
            <div class="indexBoxEventName">
               Finanse
            </div>
            <div class="indexBoxEventText">
               <div class="indexBoxEventNumberText">
                  Opłacone
               </div>
               <div class="indexBoxEventNumber indexBoxEventNumberGold">
               {{$finances['numberFinancesCompleted']}}/{{$finances['numberAllFinances']}}
               </div>
            </div>
            <div class="progressSize">  
               <div class="progress">
                  <div class="progress-bar  progress-bar-gold" role="progressbar" style="width:  {{$finances['percentageFinancesCompleted']}}%; background-color: #683cca;" aria-valuenow=" {{$finances['percentageFinancesCompleted']}}" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
            </div>
            <div class="percentageEvent">
               Ukończono <span class="indexBoxEventNumberGold">{{$finances['percentageFinancesCompleted']}}% </span>
            </div>
         </a>
      </div>

      <div class="row col-12 p-0 m-0">
         <div class="float-left">
            <div id="chart" class="groupList mb-3 pb-2" style="height: 500px; width: 755px; margin-right:15px;">
               <div style="text-align:center; font-size:25px; color:#000; padding-top:14px;">Finanse</div>
            </div>
         </div>

         <div class="float-right">
            <div class="timeName mb-2" style="color:#656d79;">Dzisiaj</div>
            @php($todayStatus=false)
            @foreach($today as $todayTasks)
               @foreach($todayTasks->tasks as $task)
                  <div class="groupList mt-2" style="width:370px; height:50px; line-height:50px; padding-left:10px; border-left:3px solid #91cc75;">
                     {{$task->name}}
                  </div>
                  @php($todayStatus=true)
               @endforeach
            @endforeach

            @foreach($today as $todayCosts)
               @foreach($todayCosts->costs as $cost)
                  <div class="groupList mt-2" style="width:370px; height:50px; line-height:50px; padding-left:10px; border-left:3px solid #fac858;">
                     {{$cost->name}}
                  </div>
                  @php($todayStatus=true)
               @endforeach
            @endforeach

            @if(!$todayStatus)
               <span style="color:#464b52;">Brak zadań</span>
            @endif

            @php($tomorrowStatus=false)
            <div class="timeName mt-3 mb-2" style="color:#656d79;">Jutro</div>
            @foreach($tomorrow as $tomorrowTasks)
               @foreach($tomorrowTasks->tasks as $task)
                  <div class="groupList mt-2" style="width:370px; height:50px; line-height:50px; padding-left:10px; border-left:3px solid #91cc75;">
                     {{$task->name}}
                  </div>
                  @php($tomorrowStatus=true)
               @endforeach
            @endforeach

            @foreach($tomorrow as $tomorrowCosts)
               @foreach($tomorrowCosts->costs as $cost)
                  <div class="groupList mt-2" style="width:370px; height:50px; line-height:50px; padding-left:10px; border-left:3px solid #fac858;">
                     {{$cost->name}}
                  </div>
                  @php($tomorrowStatus=true)
               @endforeach
            @endforeach
            
            @if(!$tomorrowStatus)
               <span style="color:#464b52;">Brak zadań</span>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection

@push('script')
<script>

   const chart = new Chartisan({
      el: '#chart',
      url: "@chart('event_chart')",
   });

   $( "a" ).removeClass( "active" );
   $("#dashboard").addClass("active");
</script>
@endpush