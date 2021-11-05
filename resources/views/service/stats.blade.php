@extends('layouts.service')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        strona usera
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#stats").addClass("active");
</script>
@endpush