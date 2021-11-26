@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="justify-content-center">
      <div class="titlePage mb-3 col-12">
         Powiadomienia
      </div>
      
      <div class="col-12 mb-3 p-0">
         @foreach($notificationsList as $notification)
         <div class="card {{$notification->content_type}} mb-3 col-md-10 notificationCard">
            <div class="notificationHeader">{{$notification->created_at}}</div>
            <div class="card-body p-0 m-0">
               <div class="card-title notificationTitle">{{$notification->content}}</div>
            </div>
         </div>
         @endforeach
      </div>
      {{$notificationsList->links("pagination::bootstrap-4")}}
   </div>
</div>
@endsection

@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#notification").addClass("active");
</script>
@endpush