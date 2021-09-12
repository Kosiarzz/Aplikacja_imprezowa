@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('role.user')}}" class="text-decoration-none">Użytkownik </a><br>
    <a href="{{route('role.bussines')}}" class="text-decoration-none">Firma </a>
</div>
@endsection
