@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('addBusiness') }}">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Tytuł ogłoszenia</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="shortDescription" class="col-md-4 col-form-label text-md-right">Opis wyświetlany na liście wyszukiwania</label>

                <div class="col-md-6">
                    <textarea id="shortDescription" type="text" class="form-control @error('shortDescription') is-invalid @enderror" name="shortDescription" value="{{ old('shortDescription') }}"></textarea>

                    @error('shortDescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Pełny opis</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"></textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="select" class="col-lg-2 control-label">Rodzaj sali</label>
                <div class="col-lg-10">
                    <select name="mainCategory" class="form-control" id="select">
                        @foreach($category as $cate)
                            @if($cate->type == 'lokal')
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endif
                        @endforeach
                        <option value="---------">--------</option>
                        <option value="sala">Sala</option>
                        <option value="lokal">Lokal</option>
                        <option value="hotel">Hotel</option>
                        <option value="palac">Pałac</option>
                        <option value="dworek">Dworek</option>
                        <option value="zamek">Zamek</option>
                        <option value="gospoda">Gospoda</option>
                        <option value="namiot">Namiot</option>
                        <option value="ogrod">Ogród</option>
                        <option value="dom">Dom</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                Obsługiwane imprezy<br>
                @foreach($category as $cate)
                    @if($cate->type == 'party')
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$cate->name}}">
                            {{$cate->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$cate->id}}" id="{{$cate->name}}" name="party[]">
                        </div>
                    @endif
                @endforeach
                <div class="form-check">
                    <label class="form-check-label mr-4" for="Komunie">
                        Komunie
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="Komunie" name="party[]">
                </div>
                <div class="form-check">
                    <label class="form-check-label mr-4" for="Urodziny">
                    Urodziny
                    </label>
                    <input class="form-check-input" type="checkbox" value="2" id="Urodziny" name="party[]">
                </div>
            </div>

            <div class="form-group row">
                Dodatkowe informacje<br>
                @foreach($category as $cate)
                    @if($cate->type == 'dodatkowe')
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$cate->name}}">
                                {{$cate->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$cate->id}}" id="{{$cate->name}}" name="dodatkowe[]">
                        </div>
                    @endif
                @endforeach
                <div class="form-check">
                    <label class="form-check-label mr-4" for="Nocleg">
                        Nocleg
                    </label>
                    <input class="form-check-input" type="checkbox" value="Nocleg" id="Nocleg">
                </div>
            </div>

            <div class="form-group row">
                <label for="beds" class="col-md-4 col-form-label text-md-right">Ilość miejsc noclegowych</label>

                <div class="col-md-6">
                    <input id="beds" type="number" min="0" class="form-control @error('beds') is-invalid @enderror" name="beds" value="{{ old('beds') }}">

                    @error('beds')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr> 
            Sala
            <div class="form-group row">
                <label for="priceFrom" class="col-md-4 col-form-label text-md-right">Cena od</label>

                <div class="col-md-6">
                    <input id="priceFrom" type="number" min="0" class="form-control @error('priceFrom') is-invalid @enderror" name="priceFrom" value="{{ old('priceFrom') }}">

                    @error('priceFrom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="priceTo" class="col-md-4 col-form-label text-md-right">Cena do</label>

                <div class="col-md-6">
                    <input id="priceTo" type="number" min="0" class="form-control @error('priceTo') is-invalid @enderror" name="priceTo" value="{{ old('priceTo') }}">

                    @error('priceTo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="unit" class="col-md-4 col-form-label text-md-right">Jednostka</label>

                <div class="col-md-6">
                    <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="zł, od osoby, za 1h itp.">

                    @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="titleRoom" class="col-md-4 col-form-label text-md-right">Tytuł sali</label>

                <div class="col-md-6">
                    <input id="titleRoom" type="text" class="form-control @error('titleRoom') is-invalid @enderror" name="titleRoom" value="{{ old('titleRoom') }}">

                    @error('titleRoom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descriptionRoom" class="col-md-4 col-form-label text-md-right">Opis sali</label>

                <div class="col-md-6">
                    <input id="descriptionRoom" type="text" class="form-control @error('descriptionRoom') is-invalid @enderror" name="descriptionRoom" value="{{ old('descriptionRoom') }}">

                    @error('descriptionRoom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="minPeople" class="col-md-4 col-form-label text-md-right">Minimalna ilość osób</label>

                <div class="col-md-6">
                    <input id="minPeople" type="number" min="0" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople" value="{{ old('minPeople') }}">

                    @error('minPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="maxPeople" class="col-md-4 col-form-label text-md-right">Maksymalna ilość osób</label>

                <div class="col-md-6">
                    <input id="maxPeople" type="number" min="0" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople" value="{{ old('maxPeople') }}">

                    @error('maxPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="sizeRoom" class="col-md-4 col-form-label text-md-right">Wielkość sali</label>

                <div class="col-md-6">
                    <input id="sizeRoom" type="number" min="0" class="form-control @error('sizeRoom') is-invalid @enderror" name="sizeRoom" value="{{ old('sizeRoom') }}">

                    @error('sizeRoom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Zdjęcia sali</label>

                <div class="col-md-6">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="imageRoom" multiple>
                    
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <button>Dodaj cennik</button>
            <button>Dodaj sale</button>
            <hr>
            Dane kontaktowe
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Imie</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="surname" class="col-md-4 col-form-label text-md-right">Nazwisko</label>

                <div class="col-md-6">
                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="businessName" class="col-md-4 col-form-label text-md-right">Nazwa firmy</label>

                <div class="col-md-6">
                    <input id="businessName" type="text" class="form-control @error('businessName') is-invalid @enderror" name="businessName" value="{{ old('businessName') }}">

                    @error('businessName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="nip" class="col-md-4 col-form-label text-md-right">NIP</label>

                <div class="col-md-6">
                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}">

                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Numer telefonu</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            Media społecznośćiowe
            <div class="form-group row">
                <label for="www" class="col-md-4 col-form-label text-md-right">Link do strony wwww</label>

                <div class="col-md-6">
                    <input id="www" type="text" class="form-control @error('www') is-invalid @enderror" name="www" value="{{ old('www') }}">

                    @error('www')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="facebook" class="col-md-4 col-form-label text-md-right">Link do facebooka</label>

                <div class="col-md-6">
                    <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}">

                    @error('facebook')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="instagram" class="col-md-4 col-form-label text-md-right">Link do instagrama</label>

                <div class="col-md-6">
                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram') }}">

                    @error('instagram')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="youtube" class="col-md-4 col-form-label text-md-right">Link do youtube</label>

                <div class="col-md-6">
                    <input id="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ old('youtube') }}">

                    @error('youtube')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            Adres
            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">Miasto</label>

                <div class="col-md-6">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">

                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="street" class="col-md-4 col-form-label text-md-right">Ulica i numer</label>

                <div class="col-md-6">
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}">

                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="postCode" class="col-md-4 col-form-label text-md-right">Kod pocztowy</label>

                <div class="col-md-6">
                    <input id="postCode" type="text" class="form-control @error('postCode') is-invalid @enderror" name="postCode" value="{{ old('postCode') }}">

                    @error('postCode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Zdjęcia lokalu</label>

                <div class="col-md-6">
                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="youtubeMovie" class="col-md-4 col-form-label text-md-right">Link do filmiku na youtube promujący</label>

                <div class="col-md-6">
                    <input id="youtubeMovie" type="text" class="form-control @error('youtubeMovie') is-invalid @enderror" name="youtubeMovie" value="{{ old('youtubeMovie') }}">

                    @error('youtubeMovie')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>

                <div class="col-md-6">
                    <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                    
                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <label for="timeOpen" class="col-md-4 col-form-label text-md-right">Godziny otwarcia</label>

                <div class="col-md-6">
                    <textarea id="timeOpen" type="text" class="form-control @error('timeOpen') is-invalid @enderror" name="timeOpen" value="{{ old('timeOpen') }}"></textarea>

                    @error('timeOpen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            Q&A
            <button>Dodaj pytanie</button>

        </form>
    </div>
</div>
@endsection
