@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center mt-5">
        <form method="post" action="{{route('businessSearch')}}" class="form-inline" style="margin-bottom:30px;">
            
            <select class="form-select" aria-label="Default select example" name="mainCategory">
                <option value="0" selected>Wszystkie</option>
                @foreach($mainCategories[0]->groupCategory as $gCategory)
                    @foreach($gCategory->category as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                @endforeach
            </select>
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

        @if(!$businesses->isEmpty())
            @foreach($businesses as $object)
                <a href="{{route('businessDetails',['id' => $object->id])}}"><div class="row border w-100 mb-4">
                <img src="{{asset('storage/'.$object->photos->first()->path)}}" class="w-50" alt="NIE MA">
                    {{$object->title}} ({{$object->name}})<br>
                    {{$object->short_description}}<br>
                    od {{$object->priceFrom}}
                    do {{$object->priceTo}} 
                    {{$object->unit}} <br>              
                </div></a>
            @endforeach
        @else
            Brak wyników wyszukiwania
        @endif
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
