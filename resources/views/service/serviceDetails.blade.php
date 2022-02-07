@extends('layouts.service')
@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      <div class="groupList row col-12 mb-3" style="">
         <div class="col-12 mb-3 mt-2 border-bottom" style="text-align:center; font-size:30px;">
            {{$service->title}}
         </div>
         <div class="row col-12 mt-0 mb-5 pl-4" style="font-size:18px; white-space: pre-line;">
            {{$service->description}}
         </div>
      </div>
      <div class="businessBox mb-5" style="width:30.4%;">
         <div class="businessBoxIcon">
            <i class="fas fa-users"></i>
         </div>
         <div class="businessBoxRight">
            <div class="businessBoxNubmer">
               @if($service->people_from == $service->people_to)
                  {{$service->people_from}}
               @else
                  od {{$service->people_from}}
                  do {{$service->people_to}} 
               @endif
            </div>
            <div class="businessBoxText">
            @if($service->business->name_category == 'room')
               osób
            @else
               osób w zespole
            @endif
            </div>
         </div>
      </div>
      <div class="businessBox mb-2" style="width:32.4%;">
         <div class="businessBoxIcon">
            <i class="fas fa-money-check-alt"></i>
         </div>
         <div class="businessBoxRight">
            <div class="businessBoxNubmer">
               @if($service->price_from == $service->price_to)
                  <span class="money">{{$service->price_from}}</span> zł
               @else
                  od <span class="money">{{$service->price_from}}</span> zł
                  do <span class="money">{{$service->price_to}}</span> zł
               @endif
            </div>
            <div class="businessBoxText">
               {{$service->unit}}
            </div>
         </div>
      </div>
      @if($service->business->name_category == 'room')
         <div class="businessBox mb-2" style="width:32.4%;">
            <div class="businessBoxIcon">
               <i class="fas fa-house-user"></i>
            </div>
            <div class="businessBoxRight">
               <div class="businessBoxNubmer">
                  {{$service->size}} m<sup>2</sup>
               </div>
               <div class="businessBoxText">
                  Wielkość
               </div>
            </div>
         </div>
      @endif

      @if(!$service->photos->isEmpty())
      <div class="row justify-content-center mt-1 groupList p-3">
         <div id="carouselExampleControls" class="carousel slide pl-1" data-ride="carousel">
            <div class="carousel-inner" style="width:900px; height:500px;">
               @php($i = 1)
               @foreach($service->photos as $photo)
                  @if($i == 1)
                     <div class="col-12 carousel-item active" style="width:900px; height:500px;">
                        <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                     </div>
                  @else
                     <div class="col-12 carousel-item" style="width:900px; height:500px;">
                        <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                     </div>
                  @endif   
                  @php($i++)
               @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
      @endif
      <div class="row col-12 justify-content-center mt-3">
         <a href="{{ route('service.serviceEdit', ['id' => $service->id]) }}" class="btn btn-primary mr-3">Edytuj</a>
         <a href="{{ route('service.serviceDelete', ['id' => $service->id]) }}" class="btn btn-danger">Usuń</a>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#servicePreview").addClass("active");

   var money = document.getElementsByClassName("money");
    
   for(var i = 0; i < money.length; i++) {
   
      result = numberWithSpaces(money[i].innerText);
      document.getElementsByClassName("money")[i].innerText = result;
   }

   function numberWithSpaces(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }
</script>
@endpush