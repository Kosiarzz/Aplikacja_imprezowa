@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row md-12 mb-2 justify-content-center">
      <div style="width:100%; text-align:center; font-size:30px; color:3a4754;">Polubione firmy</div>
   </div>
   <div class="row md-12">
      @foreach($user->businesses as $business)
         <div class="card row col-12 mb-3 p-0 reservationCard">
            <div class="row no-gutters">
               <div class="col-md-4 reservationImg"> 
                  <img src="{{asset('storage/'.$business->photos->first()->path)}}" class="card-img" alt="zdjęcie">
               </div>
               <div class="col-md-4">
                  <div class="card-body">
                     <a href="{{ route('businessDetails', ['id' => $business->id])}}">
                        <h5 class="card-title">{{$business->title}}</h5>
                     </a>
                     <h6 class="card-title">{{$business->name}}</h6>
                     <h6 class="phone" class="card-title">
                        @foreach($business->contactable as $contact)
                        {{$contact->phone}}
                        @endforeach
                     </h6>
                     <h6 class="card-title">{{$business->city->name}}, {{$business->address->street}}</h6>
                  </div>
               </div>
               <div class="col-md-4 ">
                  <div class="card-body">
                  <a href="{{ route('unlike', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}" style="margin-left:320px;"><i class="fas fa-heart" style="font-size:25px;" ></i></a>
                     <h6 class="card-title">
                        {{$business->short_description}}
                     </h6>
                  </div>
               </div>
            </div>
         </div>
      @endforeach
   </div>
   @endsection
</div>
@push('script')
<script>
   var phone = document.getElementsByClassName("phone");
   
   for(var i = 0; i < phone.length; i++) {
   
      result = numberWithSpaces(phone[i].innerText);
      document.getElementsByClassName("phone")[i].innerText = result;
   }
   
   function numberWithSpaces(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
   }

</script>
@endpush