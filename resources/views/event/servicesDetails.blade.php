@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        
       <div class="row col-md-12">
        @foreach($services as $service)        
            @foreach($service->businesses as $business)
                {{$business->name}}
            @endforeach
        @endforeach
        </div>


        <a href="{{ route('frontend.search')}}" class="links btn-primary">Wyszukaj więcej firm</a>
    </div>
</div>
@endsection
