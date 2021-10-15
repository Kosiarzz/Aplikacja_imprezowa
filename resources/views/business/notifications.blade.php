@extends('layouts.business')

@section('content')
<div class="container">

            @foreach($notifications as $notification)
                {{$notification->content}}<br>
                Status: {{$notification->status}}<br>
                Shown: {{$notification->shown}}
                <hr>
            @endforeach
</div>
@endsection
