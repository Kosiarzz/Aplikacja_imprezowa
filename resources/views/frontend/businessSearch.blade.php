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
      <a href="{{route('businessDetails',['id' => $object->id])}}" class="row col-12 groupList p-2 mb-3" style="height:215px;">
                
            <div class="col-md-4 p-0 searchPage">
               <img src="{{asset('storage/'.$object->photos->first()->path)}}" class="card-img" alt="zdjęcie">
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between pl-3 h3">
                        <div class="">
                        {{str_limit($object->title,55)}}
                        </div>
                        <div class="">
                        @can('isUser')
                            @if($object->isLiked())
                                <i class="fas fa-heart"></i>
                            @else
                                <i class="far fa-heart"></i>
                            @endif
                        @endcan
                        </div>
                    </div> 
               </div>
               <div class="row">
                  <div class="col-md-8 pl-3">
                     <h5 class="card-title">{{$object->mainCategory->name}}, {{$object->city->name}} <i class="fas fa-map-marker-alt"></i> <i class="fas fa-star ml-3"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>(5)</h5>
                     <h6 class="card-title"  style="height:90px;">{{$object->short_description}}</h6>
                  </div>
                  <div class="col-md-4">
                     <h5 class="card-title">
                         @foreach($object->services as $service)
                            od {{$service->price_from}} zł do {{$service->price_from}} zł / {{$service->unit}}
                            @break
                         @endforeach
                     </h5>
                     <h5 class="card-title">
                            
                     </h5>

                  </div>
                  <div class="col-8 pl-3"> 
                        @foreach($object->categories as $groupCategory)
                            {{$groupCategory->category[0]->name}}
                        @endforeach
                  </div>
               </div>
            </div>
         
      </a>
      @endforeach
      @else
      <div class="col-12 noResultsSearch text-center">
         Brak wyników wyszukiwania
      </div>
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