@extends('layouts.event')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

    <div class="titlePage mb-3">
            Polubione usługi
        </div>
       <div class="row col-md-12">
        @foreach($services as $service) 
            @if(empty($services[0]->businesses[0])) 
                <div class="titlePage mb-3">
                Nie masz jeszcze żadnych Ulubionych firm
                </div>
            @endif
            @foreach($service->businesses as $business)
            <div class="row col-md-12">
            <div class="card row col-12 mb-3 p-0">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{$business->photos->first()->path}}" class="card-img" alt="zdjęcie">
                    </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <a href="{{ route('businessDetails', ['id' => $business->id])}}"><h5 class="card-title">{{$business->title}}</h5></a>
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
                        <a href="{{ route('businessDetails', ['id' => $business->id])}}#services" class="btn btn-primary">Zarezerwuj</a>
                        </h5>
                    </div>
                </div>
            </div>
</div>



                
                
            @endforeach
        @endforeach
        </div>

        <form method="post" action="{{route('businessSearch')}}" class="form-inline" style="margin-bottom:30px;">
            <input type="hidden" name="mainCategory" value="{{$category}}">
            <input type="hidden" name="city" value="">
            <button type="submit" class="btn btn-info">Wyszukaj więcej firm</button>
             {{csrf_field()}}
        </form>

    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#service").addClass("active");
</script>
@endpush