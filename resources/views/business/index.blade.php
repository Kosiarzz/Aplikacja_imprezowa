@extends('layouts.business')

@section('content')
<div class="container">
    <div class="titlePage mb-3 mt-3 col-12" style="text-align:center; padding-right:18%;">
         Twoje usługi<span style="position:absolute; right:18%;"><a href="{{ route('business.category') }}" class="btn btn-primary">Dodaj usługę</a></span>
    </div>
    
    <div class="row">
        @foreach($businesses as $business) 
            <a href="{{route('service.index', ['id' => $business->id])}}" class="businessBoxButtonCategory p-2">
                <div class="businessBoxTitle">
                    <div class="title-business">
                        {{$business->title}}
                    </div>
                    <div class="businessBoxNotifications">
                    @if(count($business->notification->where('status', 0)) > 0)
                        <div class="p-0 m-0" style="font-size:15px;">Nowe powiadomienia: {{ count($business->notification->where('status', 0)) }} <i class="fas fa-bell" style="font-size:15px;"></i> </div>
                    @else
                        <div class="p-0 m-4" style="font-size:15px;"></div>
                    @endif
                    </div>
                </div> 
            </a>
        @endforeach
    </div>
</div>
@endsection
@push('script')
<script>
    $(".title-business").each(function () {
        var numChars = $(this).text().length; 
        console.log(numChars);
        if ((numChars >= 90)) {
            $(this).css("font-size", "0.7em");
        }       
    });
</script>
@endpush
