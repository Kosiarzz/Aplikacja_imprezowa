@extends('layouts.app')
@section('content')
<div class="container mt-5">
<div class="row md-12">
   <b>polubione firmy({{$user->businesses->count()}})</b>
</div>
<div class="row md-12">
   @foreach($user->businesses as $business)
   <div class="row col-md-12">
      <div class="card row col-12 mb-3 p-0">
         <div class="row no-gutters">
            <div class="col-md-4">
               <img src="{{$business->photos->first()->path}}" class="card-img" alt="zdjęcie">
            </div>
            <div class="col-md-4">
               <div class="card-body">
                  <a href="{{ route('businessDetails', ['id' => $business->id])}}">
                     <h5 class="card-title">{{$business->title}}</h5>
                  </a>
                  <h6 class="card-title">{{$business->name}}</h6>
                  <h6 class="card-title">
                     @foreach($business->contactable as $contact)
                     {{$contact->phone}}
                     @endforeach
                  </h6>
                  <h6 class="card-title">{{$business->city->name}}, {{$business->address->street}}</h6>
               </div>
            </div>
            <div class="col-md-4 ">
               <div class="card-body ">
                  <h6 class="card-title">
                     {{$business->short_description}}
                  </h6>
                  <h5 class="card-title mt-4">
                     <a href="{{ route('businessDetails', ['id' => $business->id])}}" class="btn btn-primary">Firma</a>
                     <a href="{{ route('unlike', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}" class="btn btn-danger">Usuń</a>
                  </h5>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@endsection