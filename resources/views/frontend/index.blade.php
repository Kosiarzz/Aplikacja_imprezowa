@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <form method="post" action="{{route('businessSearch')}}" class="form-inline" style="margin-bottom:30px;">
            <!-- 
                Dynamieczne wczytywanie miast
                FIltry dla wybranej firmy(raczej po wszystkich danych)
            -->
            <div class="form-group mr-2">
                <label class="sr-only" for="city">Miasto</label>
                <input name="city" type="text" value="{{old('city')}}" class="form-control autocomplete" id="city" placeholder="City">
            </div>
            <div class="form-group mr-2">
                <label class="sr-only" for="day_in">Cena od</label>
                <input name="check_in" type="text" value="{{old('check_in')}}" class="form-control datepicker" id="check_in" placeholder="Cena od">
            </div>

            <div class="form-group mr-2">
                <label class="sr-only" for="day_out">Cena do</label>
                <input name="check_out" type="text" value="{{old('check_out')}}" class="form-control datepicker" id="check_out" placeholder="Cena do">
            </div>
          
            <button type="submit" class="btn btn-info">Szukaj</button>
             {{csrf_field()}}
        </form>
        @if(session('nobusiness'))
            {{session('nobusiness')}}
        @endif

        @foreach($businesses as $business)
            <a href="{{route('businessDetails',['id' => $business->id])}}">
                <div class="row border mb-4" style="width:1000px;">
                    <img width="219" height="121" src="{{$business->photos->first()->path ?? $defaultPhoto}}" alt="NIE MA">
                    {{$business->title}} ({{$business->city->name}})<br>
                    {{$business->range}}<br>
                    {{$business->short_description}}<br>
                    od {{$business->priceFrom}}
                    do {{$business->priceTo}} 
                    {{$business->unit}} <br>
                    <button style="width:140px; height:30px; font-size:12px;">Dodaj do ulubionych</button>
                </div>
            </a>
        @endforeach
        
    </div>
    <!--
        #Zdjęcie główne
        #tytuł
        #adres firmy (miasto,ulica i numer)
        #zakres działania firmy
        #krótki opis
    #dodanie do ulubionych
    oceny(gwiazdki)
    najbliższy wolny termin
        #zakres cenowy
        #jednostka(za dzień/godzine/osobę etc)
    kategorie??
    -->

    {{$businesses->links("pagination::bootstrap-4")}}
</div>
@endsection
