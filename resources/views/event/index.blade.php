@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{session('event')}}
        {{$events->name}}<br>
        {{$events->date_event}}<br>
        {{$events->category->name}}<br>
        {{$events->budget}}
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#dashboard").addClass("active");
</script>
@endpush
