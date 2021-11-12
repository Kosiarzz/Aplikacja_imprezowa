@extends('layouts.service')
@section('content')
<div class="container mt-5">
   <div class="justify-content-center">
      <div class="titlePage mb-3 col-12">
         Powiadomienia
      </div>
      <div class="col-12 mb-3 p-0">
         @foreach($notificationsList->notification as $notification)
         <div class=" text-white {{$notification->content_type}} mb-3 col-md-10">
            <div class="card-header">{{$notification->created_at}}</div>
            <div class="card-body">
               <h4 class="card-title">{{$notification->content}}</h4>
               <p class="card-text"></p>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#notifications").addClass("active");
</script>
@endpush