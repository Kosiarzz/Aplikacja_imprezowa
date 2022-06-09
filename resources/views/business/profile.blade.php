@extends('layouts.business')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data" class="row col-7 groupList pt-4 pb-4">
            @csrf 
            <div class="row col-12 ml-2">
                @if(!is_null($user->photos))
                    <img id="image" src="{{asset('storage/'.$user->photos->path)}}" class="rounded-circle border" alt="avatar">
                @else
                    <img id="image" src="defaultAvatar" class="rounded-circle border" alt="avatar">
                @endif
                
            </div>
            <div class="form-group row col-12 border-bottom m-0 p-0">
                <div class="col-md-6 ml-5 p-0 pb-3" style="padding-left:75px!important;">
                    <input type="file" style="width:300px; height:40px; margin-top:10px; border:1px solid #558ACA;" class="form-control @error('image') is-invalid @enderror ml-5 p-0 py-1 pl-2" name="image" onchange="readURL(this);">
                    
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row col-12 mt-3">
                <div class="form-group row col-12">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Imie</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->contactable[0]->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row col-12">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">Nazwisko</label>

                    <div class="col-md-8">
                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->contactable[0]->surname }}">

                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row col-12">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Numer telefonu</label>

                    <div class="col-md-8">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->contactable[0]->phone }}">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div style="width:100%;">
                    <button type="submit" class="btn btn-primary" style="float:right!important;">Zapisz zmiany</button>
                </div>
            </div>
        </form>
            
        <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data" class="row col-7 mt-3 groupList p-4">
        @csrf 
            <div class="form-group row col-12">
                <label for="email" class="col-md-4 col-form-label text-md-right">Nowy adres email</label>

                <div class="col-md-8">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row col-12">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row col-12">
                <div style="width:100%;">
                    <button type="submit" class="btn btn-primary" style="float:right!important;">Zmień email</button>
                </div>
            </div>  
        </form>

        <form method="POST" action="{{ route('user.updateProfile') }}" enctype="multipart/form-data" class="row col-7 mt-3 groupList p-4">
        @csrf 
            <div class="form-group row col-12">
                <label for="actualPassword" class="col-md-4 col-form-label text-md-right">Aktualne hasło</label>

                <div class="col-md-8">
                    <input id="actualPassword" type="password" class="form-control @error('actualPassword') is-invalid @enderror" name="actualPassword" required>

                    @error('actualPassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row col-12">
                <label for="password" class="col-md-4 col-form-label text-md-right">Nowe hasło</label>

                <div class="col-md-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row col-12">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Potwierdź nowe hasło</label>

                <div class="col-md-8">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="row col-12">
                <div style="width:100%;">
                    <button type="submit" class="btn btn-primary" style="float:right!important;">Zmień hasło</button>
                </div>
            </div> 
        </form>

        <div class="row col-12 p-0 m-0 mt-3 justify-content-center">
            <a href="#" class="btn-danger p-2" style="border-radius:4px;">Usuń konto</a>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
