@extends('layouts.app')

@section('content')
<div class="container">

            <button>Dodaj usługę</button>
            
            @foreach($businesses as $business)
            <div>
                <a href="{{ route('business.id', ['id' => $business->id]) }}">{{$business->title}}</a>
            </div><br>
            @endforeach

</div>
@endsection
