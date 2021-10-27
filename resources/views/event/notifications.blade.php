@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        Powiadomienia
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#notification").addClass("active");
</script>
@endpush