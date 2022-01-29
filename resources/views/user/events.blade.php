@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row md-12 mb-2">
            <div style="width:100%; text-align:center; font-size:30px; color:3a4754;">Twoje wydarzenia</div>
        </div>
        <div class="row col-12 m-0 p-0 groupList mb-3 p-3" style="display:flex; justify-content:center;">
            @if($status == 'actual')
                <a href="{{route('user.events')}}" class="serviceButton mr-3 serviceButtonActive">Aktualne</a>
                <a href="{{route('user.endEvents')}}" class="serviceButton mr-3 ">Zakończone</a>
            @else
                <a href="{{route('user.events')}}" class="serviceButton mr-3">Aktualne</a>
                <a href="{{route('user.endEvents')}}" class="serviceButton mr-3 serviceButtonActive">Zakończone</a>
            @endif
            <a href="{{route('event.createEvent')}}" class="serviceButton mr-3 " style="width:150px!important;">Stwórz wydarzenie</a>
        </div>
        <div class="row col-md-12 m-0 p-0 ml-5">
            @foreach($events as $event)
                <a href="{{route('event.index', ['id' => $event->id])}}" class="serviceBoxButton eventBoxButton mr-3 ">
                    <div class="serviceBoxTitle p-0">
                        <div class="p-0 m-0 mb-2" style="padding-top:5px;">{{$event->name}}</div>
                        <img src="{{asset('storage/icons/'.$event->category->name.'.png')}}" class="icons-img" style="color:#00528D;" alt="wydarzenie">
                        @if($status == 'actual')
                            <div class="p-0 m-0" style="font-size:22px;">za <span style="font-size:26px">{{date_diff(date_create(date("d.m.Y")), date_create($event->date_event))->format('%a')}}</span> dni</div>
                            <div class="p-0 m-0" style="font-size:18px;">{{date('d.m.Y', strtotime($event->date_event))}}</div>
                        @else
                            <div class="p-0 m-0" style="font-size:22px;">wydarzenie odbyło się</div>
                            <div class="p-0 m-0" style="font-size:26px;">{{date('d.m.Y', strtotime($event->date_event))}}</div>
                        @endif
                        @if(count($event->notifications->where('status', 0)) > 0)
                            <div class="p-0 m-0" style="font-size:14px;"><i class="fas fa-bell" style="font-size:14px;"></i> {{ count($event->notifications->where('status', 0)) }} nowe powiadomienie</div>
                        @else
                            <div class="p-0 m-4" style="font-size:14px;"></div>
                        @endif
                    </div>
                </a>  
            @endforeach
        </div>
        {{$events->links("pagination::bootstrap-4")}}
    </div>
</div>
@endsection
