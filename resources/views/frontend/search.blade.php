@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="row col-12 groupList p-0 m-0 mb-4">
      <div class="row col-12 filter-title m-0 p-0 mb-4 pt-1 pl-2">
         Filtry
      </div>
      <form method="get" action="{{route('businessSearch')}}" class="row col-12 filter" style="margin-bottom:10px;">

         <i class="fas fa-tags ml-3" style="font-size:24px; margin-top:7px;"></i>
         <div class="mr-4">
            <select class="form-control filter-input ml-2" aria-label="Default select example" name="mainCategory">
               <option value="0" selected>Wszystkie</option>
                @foreach($mainCategories[0]->groupCategory as $gCategory)
                    @foreach($gCategory->category as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                @endforeach
            </select>
         </div>
         <i class="fas fa-map-marker-alt mr-2 ml-2" style="font-size:24px; margin-top:7px;"></i>
         <div class="form-group mr-2">
            <label class="sr-only" for="city">Miasto</label>
            <input name="city" type="text" value="{{old('city')}}" class="form-control autocomplete" id="city" placeholder="City">
         </div>
         <i class="fas fa-search-dollar mr-2 ml-2" style="font-size:24px; margin-top:7px;"></i>
         <div class="form-group mr-2">
            <label class="sr-only" for="day_in">Cena od</label>
            <input name="check_in" type="text" style="width:140px;" value="{{old('check_in')}}" class="form-control datepicker" id="check_in" placeholder="Cena od">
         </div>
         _ 
         <div class="form-group mr-2 ml-2">
            <label class="sr-only" for="day_out">Cena do</label>
            <input name="check_out" type="text" style="width:140px;" value="{{old('check_out')}}" class="form-control datepicker" id="check_out" placeholder="Cena do">
         </div>
         <div class="row ml-1">
            <i class="far fa-star ml-3" style="font-size:24px; margin-top:7px;"></i>
            <div class="mr-3">
               <select class="form-control filter-input ml-2" aria-label="Default select example" name="rateFrom">
                  <option value="0" selected>0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
               </select>
            </div>
            _
            <div class="mr-1">
               <select class="form-control filter-input ml-2" aria-label="Default select example" name="rateTo">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5" selected>5</option>
               </select>
            </div>
         </div>
         <div class="row col-12 mt-2 justify-content-center">
         <button type="submit" class="btn btn-primary" style="width:110px;">Szukaj</button>
         </div>
         {{csrf_field()}}
      </form>
</div>
        @if(session('nobusiness'))
            {{session('nobusiness')}}
        @endif

        @if(!$businesses->isEmpty())
      @foreach($businesses as $business)
      <a href="{{route('businessDetails',['id' => $business->id])}}" class="row col-12 groupList p-2 mb-3 searchList">
            <div class="col-md-4 p-0 searchPage">
                @if($business->photos->isEmpty())
                    <img src="{{asset('storage/photos/test.png')}}" class="card-img" alt="zdjęcie">
                @else
                    <img src="{{asset('storage/'.$business->photos->first()->path)}}" class="card-img" alt="zdjęcie">
                @endif
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between pl-3 h5">
                        <div class="" style="font-size:20px; color:#333740;">
                            {{str_limit($business->title, 55)}}
                        </div>
                    </div> 
               </div>
               <div class="row">
                  <div class="col-md-8 pl-3">
                        <div class="mb-1" style="font-size:18px; color:#3F4756;"><span style="margin-right:10px;">{{$business->mainCategory->name}}, {{$business->city->name}} </span>
                                 @for($i=1; $i<=5; $i++)
                                    @if($business->rating >= $i)
                                        <i class="fas fa-star" style="color:gold; font-size:15px;"></i>
                                    @else
                                        <i class="fas fa-star" style="color:gray; font-size:15px;"></i>
                                    @endif
                                @endfor
                                <span style="color:#000; font-size:16px;">({{count($business->comments)}})</span>
                        </div>
                        <div class="decoration-none" style="height:110px; color:#333740; font-size:14px;">{{str_limit($business->short_description, 330)}}</div>
                  </div>
                  <div class="col-md-4 mb-0 justify-content-center">
                     <div class="" style="text-align:center; color:#333740;">
                            @if($business->services->min('price_from') == $business->services->max('price_to'))
                                <span style="color:#333740; font-size:20px;">Jedna oferta</span> <br><span class="money">{{$business->services->min('price_from')}}</span> zł
                            @else
                                <span style="color:#333740; font-size:20px;">Oferty</span> <br> od <span class="money">{{$business->services->min('price_from')}}</span> zł do <span class="money">{{$business->services->max('price_to')}}</span> zł
                            @endif
                     </div>
                  </div>
                  <div class="col-8 pl-3 pr-1" style="font-size: 14px;"> 
                     @foreach($business->GroupBusiness as $gBusiness)
                        @foreach($gBusiness->groupCategory as $gCategory)
                           <span style="background:#009D91; color:#fff; border-radius:15px; padding:2px 8px; margin-right:3px;">{{$gCategory->category[0]->name}}</span>
                        @endforeach 
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
    {{$businesses->links("pagination::bootstrap-4")}}
</div>
@endsection
