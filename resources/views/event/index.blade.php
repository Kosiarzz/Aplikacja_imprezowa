@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        {{$events->name}}<br>
        {{$events->date_event}}<br>
        {{$events->category->name}}<br>
        {{$events->budget}}
    </div>
</div>
@endsection
