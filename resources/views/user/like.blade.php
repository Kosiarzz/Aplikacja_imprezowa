@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        Dodane do ulubionych podzielone na kategorie dodanych: lokale itd.
        <div class="w-100 mt-5">
        Polubione firmy <br>
            @foreach($user->businesses as $business)
                {{$business->title}} <br>
            @endforeach
        </div>
        <br>
    </div>
</div>
@endsection
