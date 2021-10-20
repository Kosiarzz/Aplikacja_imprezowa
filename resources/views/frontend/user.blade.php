@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row md-12 justify-content-center">
        
        <div style="width:100%;">
            <img id="image" src="{{$user->photos->path ?? $defaultPhoto}}" class="rounded-circle" alt="avatar">
            {{$user->contactable[0]->name}} {{$user->contactable[0]->surname}} | {{$user->email}} | {{$user->contactable[0]->phone}}
        </div>
        @if($user->role == 'user')
            <div class="row col-12 justify-content-center">
                <b>Dodanych komentarzy({{$user->comments->count()}}) </b>
            </div>
            
            <div class="row col-12 justify-content-center">
                <b> Polubione firmy({{$user->businesses->count()}})</b>
            </div>
            data założenia konta, komenatrze i ocena usera, publikowanie swojej imprezy?
        @endif

        @if($user->role == 'business')
            Wyświetlenie wszystkich firm należących do tego usera
        @endif
    </div>
    

    
</div>
@endsection
