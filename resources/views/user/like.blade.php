@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row md-12">
            <b>polubione firmy({{$user->businesses->count()}})</b>
        </div>

        <div class="row md-12">
            @foreach($user->businesses as $busines)
                <a href="{{route('businessDetails', ['id' => $busines->id])}}" class="links"><div class="md-4 likeBusiness position-relative">
                <a href="{{ route('unlike', ['likeable_id' => $busines->id, 'type' => 'App\Models\Business']) }}" class="btn-danger p-1 deleteLink">x</a>
                    nazwa {{$busines->title}}<br>
                    Ocena {{str_limit($busines->description,30)}}
                </div></a>
                
            @endforeach
        </div>
    </div>
@endsection
