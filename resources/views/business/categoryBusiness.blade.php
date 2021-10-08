@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        Wybór branży
        <a href="{{route('businessProfile.profile', 'lokal')}}" class="text-decoration-none box w-100">
            <div class="title">
                Lokal?
            </div>
            <div class="description">
                Miejsce w którym może zostać zorganizowana impreza np. sala, lokal, dworek, karczma, ogród itp.
            </div>
        </a>

        <a href="{{route('businessProfile.profile', 'atrakcje')}}" class="text-decoration-none box w-100">
            <div class="title">
                Atrakcje
            </div>
            <div class="description">
                Usługi takie jak atakcjowe itp. 
            </div>
        </a>

        <a href="{{route('businessProfile.profile', 'zespolmuzyczny')}}" class="text-decoration-none box w-100">
            <div class="title">
                Muzyka
            </div>
            <div class="description">
                Grupa wykonawców muzycznych, DJ itp.
            </div>
        </a>

        <a href="{{route('businessProfile.profile', 'dekoracje')}}" class="text-decoration-none box w-100">
            <div class="title">
                Dekoracje
            </div>
            <div class="description">
                Usługi takie jak dekoratorzy, kwiaciarnie, itp.
            </div>
        </a>

        <a href="{{route('businessProfile.profile', 'katering')}}" class="text-decoration-none box w-100">
            <div class="title">
                Jedzenie i napoje
            </div>
            <div class="description">
                Usługi takie jak katering, barman, barista itp.
            </div>
        </a>

        <a href="{{route('businessProfile.profile', 'pokazy')}}" class="text-decoration-none box w-100">
            <div class="title">
                Pokazy
            </div>
            <div class="description">
                Usługi takie jak sztuczne ognie, pokazy laserowe, pokazy barmańskie itp.
            </div>
        </a>

    </div>
</div>
@endsection
