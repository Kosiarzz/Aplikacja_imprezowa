@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
    <div style="width:100%;">
           
           {{$service->title}}<br>
           {{$service->description}}<br>
           LUDZI<br>
           {{$service->people_from}}<br>
           {{$service->people_to}}<br>
           KOSZT<br>
           {{$service->price_from}}<br>
           {{$service->price_to}}<br>
           RESZTA<BR>
           {{$service->unit}}<br>
           {{$service->size}}<br>
          </div>
          <br>Zdjęcia<br>
       <div class="mb-2" style="width:100%;">
           
          @foreach($service->photos as $photo)
          <img src="{{asset('storage/'.$photo->path)}}" class="mr-3 mb-3" width="219" height="121" alt="SALA">
          @endforeach
       </div>
       <br>
       </section>
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#servicePreview").addClass("active");
</script>
@endpush