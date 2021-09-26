@extends('layouts.app')

@section('content')
<div class="container">

   
    <div class="row justify-content-center">
    <div style="width:100%;">
    <img src="{{$user->photos->path ?? $defaultPhoto}}" class="mr-3 mb-3" width="219" height="121">
      
    {{$user->name}} {{$user->surname}} | {{$user->email}}<br>
    </div>
    <b>komentarze({{$user->comments->count()}})</b><br>
    @foreach($user->comments as $comment)
    <div style="width:100%;">
        Treść {{str_limit($comment->content,50)}}<br>
        Ocena {{$comment->rating}}<br>
        
        <a href="{{route('businessDetails', ['id' => 0])}}">Link do koma</a>
    </div>
    @endforeach

    <br><br>
    <b>polubione firmy({{$user->businesses->count()}})</b><br>

    @foreach($user->businesses as $busines)
    <div style="width:100%;">
        nazwa {{$busines->title}}<br>
        Ocena {{str_limit($busines->description,50)}}
        <a href="{{route('businessDetails', ['id' => $busines->id])}}">Link do firmy</a>
    </div>
    @endforeach

    <!--
      
    -->
    </div>
</div>
@endsection
