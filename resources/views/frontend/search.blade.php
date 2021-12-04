@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
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
        @if(session('nobusiness'))
            {{session('nobusiness')}}
        @endif

        @foreach($businesses as $business)
            <a href="{{route('businessDetails',['id' => $business->id])}}">
                <div class="row border mb-4" style="width:1000px;">
                @if(!is_null($business->photos->first()))
                    <img width="219" height="121" src="{{asset('storage/'.$business->photos->first()->path)}}" alt="Zdjęcie">
                @else
                    <img width="219" height="121" src="{{asset('storage/photos/test.png')}}" alt="Zdjęcie">
                @endif
                    {{$business->title}} ({{$business->city->name}})<br>
                    {{$business->range}}<br>
                    {{$business->short_description}}<br>
                    @can('isUser')
                        @if($business->isLiked())
                            <a href="{{ route('unlike', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}">Usuń z ulubionych</a>
                        @else
                            <a href="{{ route('like', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}">Dodaj do ulubionych</a> 
                        @endif
                        
                    @elseif(!'isBusiness')
                        <a href="{{ route('login') }}">Zaloguj się</a>
                    @endcan
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
