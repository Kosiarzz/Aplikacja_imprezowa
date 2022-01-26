@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row col-12 justify-content-center">
        <div class="row col-7 groupList pt-4 pb-4">
            <div class="row col-12 ml-2">
                @if(!is_null($user->photos->path))
                    <img id="image" src="{{asset('storage/'.$user->photos->path)}}" class="rounded-circle border" alt="avatar">
                @else
                    <img id="image" src="{{$defaultAvatar}}" class="rounded-circle border" alt="avatar">
                @endif
            </div>
            <div class="col-12 mt-2" style="text-align:center;">
                <div class="" style="font-size:20px;">{{$user->contactable[0]->name}} {{$user->contactable[0]->surname}}</div>
                <div class="">{{$user->contactable[0]->phone}}</div>
            </div>
            chyba tylko firma
        </div>
    </div>
    

    
</div>
@endsection
