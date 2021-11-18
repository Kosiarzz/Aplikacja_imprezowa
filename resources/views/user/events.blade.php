@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="row md-12">
            <b>Twoje wydarzenia</b>
        </div>
        
        <div class="row col-md-12">
            @foreach($events as $event)
                <a href="{{route('event.index', ['id' => $event->id])}}" class="serviceBoxButton mr-3">
                    <div class="serviceBoxTitle">
                        {{$event->name}}<br>
                        {{$event->date_event}}<br>
                        {{ count($event->notifications->where('status', 0)) }}
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
