@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row md-12 mb-2">
            <div style="width:100%; text-align:center; font-size:30px; color:3a4754;">Twoje wydarzenia</div>
        </div>
        
        <div class="row col-md-12 text-center">
            @foreach($events as $event)
                <a href="{{route('event.index', ['id' => $event->id])}}" class="serviceBoxButton mr-3">
                    <div class="serviceBoxTitle p-0">
                        <div class="p-0 m-0" style="padding-top:5px;">{{$event->name}}</div>
                        <div class="p-0 m-0" style="font-size:22px;">za <span style="font-size:26px">{{date_diff(date_create(date("Y-m-d")), date_create($event->date_event))->format('%a')}}</span> dni</div>
                        <div class="p-0 m-0" style="font-size:14px;">{{$event->date_event}}</div>
                        @if(count($event->notifications->where('status', 0)) > 0)
                            <div class="p-0 m-0" style="font-size:14px;">{{ count($event->notifications->where('status', 0)) }} nowe powiadomienie</div>
                        @else
                            <div class="p-0 m-0" style="font-size:14px;">Brak nowych powiadomień</div>
                        @endif
                    </div>
                </a>  
 
                
            @endforeach

            <a href="{{route('event.createEvent')}}" class="serviceBoxButton">

                <div class="serviceBoxTitle">Stwórz wydarzenie</div>
             
            </a>  
        </div>
    </div>
</div>
@endsection
