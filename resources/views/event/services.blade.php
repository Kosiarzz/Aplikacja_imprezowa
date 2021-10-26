@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    
       Polubione<br>
       <div class="row col-md-12">
        @foreach($services as $service)
            @foreach($service->groupCategory as $categories)
                @foreach($categories->category as $mainCategory)
                <a href="{{ route('event.servicesDetails', ['idCategory' => $mainCategory->id])}}">{{$mainCategory->name}}({{$categories->icon_name}})</a>
                @endforeach
            @endforeach
        @endforeach
        </div>
    </div>
</div>
@endsection
