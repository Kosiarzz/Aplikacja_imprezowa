@extends('layouts.business')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($businesses as $business) 
            <a href="{{route('service.index', ['id' => $business->id])}}" class="col-4 businessBoxButton">
                <div class="businessBoxTitle">
                    {{$business->title}}
                </div>
                <div class="businessBoxNotifications">
                    
                </div>
            </a>
        @endforeach
        <a href="{{ route('business.category') }}" class="col-4 businessBoxButton">Dodaj usługę</a>
    </div>
</div>
@endsection
