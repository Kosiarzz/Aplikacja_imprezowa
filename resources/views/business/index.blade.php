@extends('layouts.business')

@section('content')
<div class="container mt-5">
    <div class="titlePage mb-3 col-12" style="text-align:center;">
         Twoje usługi<span style="position:absolute; right:0;"><a href="{{ route('business.category') }}" class="btn btn-primary">Dodaj usługę</a></span>
    </div>
    
    <div class="row">
        @foreach($businesses as $business) 
            <a href="{{route('service.index', ['id' => $business->id])}}" class="businessBoxButton">
                <div class="businessBoxTitle">
                    <div class=""
                    {{$business->title}}
                    <div class="businessBoxNotifications">
                    {{ count($business->notification->where('status', 0)) }}
                    </div>
                </div>
                
            </a>
        @endforeach
        
    </div>
</div>
@endsection
