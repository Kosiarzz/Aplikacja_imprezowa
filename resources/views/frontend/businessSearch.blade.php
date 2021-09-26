@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <form method="post" action="#" class="form-inline">
            
            <div class="form-group">
                <label class="sr-only" for="city">City</label>
                <input name="city" type="text" class="form-control autocomplete" id="city" placeholder="City">
            </div>
            <div class="form-group">
                <label class="sr-only" for="day_in">Check in</label>
                <input name="check_in" type="text" class="form-control datepicker" id="check_in" placeholder="Check in">
            </div>

            <div class="form-group">
                <label class="sr-only" for="day_out">Check out</label>
                <input name="check_out" type="text" class="form-control datepicker" id="check_out" placeholder="Check out">
            </div>
          
            <button type="submit" class="btn btn-warning">Search</button>
             @csrf
        </form>
        
        
        @foreach($businesses as $business)
            @foreach($business->businesses as $object)
                <a href="{{route('businessDetails',['id' => $object->id])}}"><div class="row border w-100 mb-4">
                <img src="{{$object->photos->first()->path ?? $defaultPhoto}}" class="w-50" alt="NIE MA">
                    {{$object->title}} ({{$business->name}})<br>
                    {{$object->range}}<br>
                    {{$object->short_description}}<br>
                    od {{$object->priceFrom}}
                    do {{$object->priceTo}} 
                    {{$object->unit}} <br>              
                </div></a>
            @endforeach
        @endforeach
    </div>
    <!--
        #Zdjęcie główne
        #tytuł
        #adres firmy (miasto,ulica i numer)
        #zakres działania firmy
        #krótki opis
    dodanie do ulubionych
    oceny(gwiazdki)
        #zakres cenowy
        #jednostka(za dzień/godzine/osobę etc)
    kategorie??
    -->
    
</div>
@endsection
