@extends('layouts.service')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{dd($data)}}
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#preview").addClass("active");
</script>
@endpush