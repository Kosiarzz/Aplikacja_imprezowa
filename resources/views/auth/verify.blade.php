@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:#558ACA; color:#fff; font-size:18px;">Zweryfikuj adres email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Nowy link aktywacyjny został wysłany na twojego maila.
                        </div>
                    @endif

                    Zanim przejdziesz dalej, potwierdź swoje konto naciskając w link przesłany na podany adres email podczas rejestracji.<br>
                    Jeżeli nie otrzymałeś maila, naciśnij poniższy link.<br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Wyślij ponownie link aktywacyjny.</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
