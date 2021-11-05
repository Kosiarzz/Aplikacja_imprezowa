@extends('layouts.service')

@section('content')
<div class="container mt-5">

      <div class="titlePage justify-content-center">
         Usługi
      </div>
    <div class="row col-md-12">

        @foreach($services->services as $service)
            <a href="{{route('service.serviceDetails', ['id' => $service->id])}}" class="serviceBoxButton mr-3">
                <div class="serviceBoxTitle">
                    {{$service->title}}<br>
                    {{$service->date_event}}
                </div>
            </a>  
        @endforeach

        <a href="{{route('service.serviceAdd')}}" class="serviceBoxButton">

            <div class="serviceBoxTitle">Dodaj usługę</div>
            
        </a>  
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#servicePreview").addClass("active");
</script>
@endpush