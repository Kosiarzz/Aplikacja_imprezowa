@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    date
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#calendar").addClass("active");
</script>
@endpush