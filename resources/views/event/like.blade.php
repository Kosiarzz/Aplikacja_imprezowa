@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
       Polubione<br>
       <div class="row col-md-12">
        @foreach($likes->businesses as $like)
            <div class="row col-6 border mr-2 mb-3 position-relative">
                {{$like->name}}<br>
                {{$like->title}}<br>
                {{$like->short_description}}<br>
                
                @foreach($like->contactable as $contact)
                    {{$contact->name}}<br>
                    {{$contact->surname}}<br>
                    {{$contact->phone}}<br>
                @endforeach

                <a href="{{ route('unlike', ['likeable_id' => $like->id, 'type' => 'App\Models\Business']) }}" class="btn-danger p-1 deleteLink">x</a>
                <div class="row col-6">
                    <a href="{{ route('businessDetails', ['id' => $like->id])}}" class="links btn-info">Link</a>
                </div>
            </div>
        @endforeach
        </div>

        <a href="{{ route('frontend.search')}}" class="links btn-primary">Wyszukaj więcej firm</a>
    </div>
</div>
@endsection
