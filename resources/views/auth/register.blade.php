@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="row md-12">
        <a href="{{route('role.user')}}" class="linkRegister">
            <div class="registerBox">
                <div class="icon"><img src="{{asset('storage/icons/event.png')}}" alt="Wydarzenie"></div>
                <div class="title">Konto użytkownika</div>
                <div class="description">Zaplanuj swoje wydarzenie, dodawaj zadania, zarządzaj finansami, przechowuj informację o gościach, przeglądaj oferty i rezerewuj usługi.</div>
            </div>
        </a>

        <a href="{{route('role.bussines')}}" class="linkRegister">
            <div class="registerBox">
                <div class="icon"><img src="{{asset('storage/icons/business.png')}}" alt="Firma"></div>
                <div class="title">Konto firmowe</div>
                <div class="description">Pokaż swoją firmę innym użytkownikom dodając swoje usługi i oferty. Sprawdzaj satystyki, zarządzaj rezerwacjami bezpośrednio w panelu usługi.</div>
            </div>
        </a>
    </div>

</div>
@endsection