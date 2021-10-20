@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="row md-12">
        <a href="{{route('role.user')}}" class="linkRegister">
            <div class="registerBox">
                <div class="icon"></div>
                <div class="title">Konto użytkownika</div>
                <div class="description">Zaplanój swoje przyjęcie, wybieraj spośród tysięcu usług</div>
            </div>
        </a>

        <a href="{{route('role.bussines')}}" class="linkRegister">
            <div class="registerBox">
                <div class="icon"></div>
                <div class="title">Konto firmowe</div>
                <div class="description">Dodaj swoją usługę</div>
            </div>
        </a>
    </div>

</div>
@endsection