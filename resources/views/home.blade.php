@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:#558ACA; color:#fff; font-size:18px;">Zalogowano</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Zostałeś zalogowany!<br>
                    @can('isUser')
                        <a href="{{route('user.events')}}" class="serviceButton p-2">Przejdź do wydarzeń</a>
                    @elseif('isBusiness')
                        <a href="{{ route('business.index') }}"class="serviceButton p-2">Przejdź do usług</a>
                    @endcan
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
