@extends('layouts.app')

@section('content')
<div class="container">

            <div>
                <a href="{{ route('business.category') }}">Dodaj usługę</a>
            </div><br>
            
            @foreach($businesses as $business)
            <div>
                <a href="{{ route('business.id', ['id' => $business->id]) }}">{{$business->title}}</a>
            </div><br>
            @endforeach

</div>
@endsection
