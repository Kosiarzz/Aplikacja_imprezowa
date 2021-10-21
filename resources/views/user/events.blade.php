@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row md-12">
            <b>Twoje wydarzenia</b>
        </div>
        <div class="row col-md-12">
            @foreach($events as $event)
                <a href="{{route('event.index', ['id' => $event->id])}}" class="links mr-3">
                    <div class="col-md-12 likeBusiness position-relative">
                        {{$event->name}}<br>
                        {{$event->date_event}}
                    </div>
                </a>  
            @endforeach

            <a href="{{route('event.createEvent')}}" class="links">
                <div class="col-md-12 likeBusiness position-relative">
                    Stwórz wydarzenie
                </div>
            </a>  
        </div>
        wyszukiwanie po nazwie 
        paginacja
        Wyświetlanie stworzonych eventów aktualne i zakończone (dwie karty  na jednej stronie)
    </div>
</div>
@endsection
