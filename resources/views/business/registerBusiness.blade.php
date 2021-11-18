@extends('layouts.business')

@section('content')
<div class="container w-100">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('addBusiness') }}" enctype="multipart/form-data">
            @csrf

            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">@if($selectCategory == "room")
                        Rodzaj budynku
                    @else
                        Rodzaj usługi
                    @endif</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="mainCategorySection">></a></div>
                
                </div> 
                <div id="mainCategorySection">

                <div class="form-group mt-3">
                <div class="col-lg-6">
                    <select name="mainCategory" class="form-control" id="select">   
                        @foreach($category as $serviceCategory) 
                            @foreach($serviceCategory->groupCategory as $gCategory) 
                                @foreach($gCategory->category as $mainCategory) 
                                    <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>
                            @endforeach
                        @endforeach
                        @endforeach
                    </select>
                </div>
            </div>


                </div> </div>  

            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">Informacje o ogłoszeniu </div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="informationSection">></a></div>
                
                </div> 
                <div id="informationSection">
                    <div class="form-group row">
                        <label for="title" class="col-md-6 col-form-label text-md-left">Tytuł ogłoszenia</label>
                        <label for="title" class="col-md-6 col-form-label text-md-right">100</label>
                        <div class="col-md-12">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="shortDescription" class="col-md-10 col-form-label text-md-left">Opis wyświetlany na liście wyszukiwania</label>
                        <label for="shortDescription" class="col-md-2 col-form-label text-md-right">300</label>
                        <div class="col-md-12">
                            <textarea id="shortDescription" type="text" class="form-control @error('shortDescription') is-invalid @enderror" name="shortDescription" value="{{ old('shortDescription') }}"></textarea>

                            @error('shortDescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-6 col-form-label text-md-left">Pełny opis</label>
                        <label for="description" class="col-md-6 col-form-label text-md-right">2000</label>
                        <div class="col-md-12">
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">Wybór kategori</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="categorySection">></a></div>
                
                </div> 
                <div id="categorySection">
            <div class="form-group row">
                <div class="col-md-12 mb-2">Obsługiwane imprezy</div>
                @foreach($categoryParty as $cParty) 
                        @foreach($cParty->groupCategory as $gPartyCategory) 
                            @foreach($gPartyCategory->category as $partyCategory) 
                
                    <div class="form-check">
                        <label class="form-check-label mr-4" for="{{$partyCategory->name}}">
                        {{$partyCategory->name}}
                        </label>
                        <input class="form-check-input" type="checkbox" value="{{$partyCategory->id}}" id="{{$partyCategory->name}}" name="party[]">
                    </div>
                
                @endforeach
                @endforeach
                @endforeach
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12 mb-2">Dodatkowe informacje</div>
                @foreach($categoryAdditional as $cAdditional) 
                        @foreach($cAdditional->groupCategory as $gAdditionalCategory) 
                            @foreach($gAdditionalCategory->category as $additionalCategory) 
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$additionalCategory->name}}">
                                {{$additionalCategory->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$additionalCategory->id}}" id="{{$additionalCategory->name}}" name="additional[]">
                        </div>
                    
                @endforeach
                @endforeach
                @endforeach
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12 mb-2">Inni użytkownicy dodali również</div>
                
                @foreach($categoryStats as $categoryUser)
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$categoryUser->category->name}}">
                                {{$categoryUser->category->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$categoryUser->category->id}}" id="{{$categoryUser->category->name}}" name="popular[]">
                        </div>
                @endforeach
            </div>
            <hr>
            <div id="userCategory" class="form-group row">
                <div class="col-md-12 mb-2">Dodaj własne kategorie</div>
                <!-- Kategorie dodane przez usera -->
            </div>
            <div class="row justify-content-center">
                    <input type="text" id="userInputCategory">
                    <div class="btn-info p-2 ml-2" onClick="addCategory();">Dodaj kategorie</div>
                </div>
                <div id="modalBeds" class="form-group row mt-3">
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
</div></div>
            
            
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">
                        @if($selectCategory == "room")
                            Wynajmowana przestrzeń
                        @else
                            Oferowana usługa
                        @endif
                    </div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="serviceSection">></a></div>
                
                </div> 
                <div id="serviceSection">
            
            <div class="form-group row mt-4">
                <label for="priceFrom" class="col-md-4 col-form-label text-md-right">Cena od</label>

                <div class="col-md-6">
                    <input id="priceFrom" type="number" min="0" class="form-control @error('priceFrom') is-invalid @enderror" name="priceFrom[]" value="{{ old('priceFrom') }}">

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
                    <input id="priceTo" type="number" min="0" class="form-control @error('priceTo') is-invalid @enderror" name="priceTo[]" value="{{ old('priceTo') }}">

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
                    <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit[]" value="{{ old('unit') }}" placeholder="osoba, 1h, doba itp.">

                    @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="titleService" class="col-md-4 col-form-label text-md-right">Tytuł</label>

                <div class="col-md-6">
                    <input id="titleService" type="text" class="form-control @error('titleService') is-invalid @enderror" name="titleService[]" value="{{ old('titleService') }}">

                    @error('titleService')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descriptionService" class="col-md-4 col-form-label text-md-right">Opis</label>

                <div class="col-md-6">
                    <input id="descriptionService" type="text" class="form-control @error('descriptionService') is-invalid @enderror" name="descriptionService[]" value="{{ old('descriptionService') }}">

                    @error('descriptionService')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="minPeople" class="col-md-4 col-form-label text-md-right">
                @if($selectCategory == "room")
                    Minimalna ilość osób
                @else
                    Ilość osób w zespole
                @endif
                </label>

                <div class="col-md-6">
                    <input id="minPeople" type="number" min="0" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople[]" value="{{ old('minPeople') }}">

                    @error('minPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @if($selectCategory == "room")
            <div class="form-group row">
                <label for="maxPeople" class="col-md-4 col-form-label text-md-right">Maksymalna ilość osób</label>

                <div class="col-md-6">
                    <input id="maxPeople" type="number" min="0" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople[]" value="{{ old('maxPeople') }}">

                    @error('maxPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="sizeService" class="col-md-4 col-form-label text-md-right">Wielkość [m^2]</label>

                <div class="col-md-6">
                    <input id="sizeService" type="number" min="0" class="form-control @error('sizeService') is-invalid @enderror" name="sizeService[]" value="{{ old('sizeService') }}">

                    @error('sizeService')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @endif
            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">
                    Zdjęcia związane z ofertą
                </label>

                <div class="col-md-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="imageService[]" multiple>
                   
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div id="service"></div>
            <a class="btn-primary p-2" onClick="addService()">Dodaj więcej</a>
            </div></div>
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">Dane kontaktowe</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="contactSection">></a></div>
                
                </div> 
                <div id="contactSection">
            <div class="form-group row mt-4">
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
            </div></div>
           
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle"> Media społecznośćiowe</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="socialSection">></a></div>
                
                </div> 
                <div id="socialSection">
            <div class="form-group row mt-4">
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
            </div></div></div>
           
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle"> Adres firmy</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="addressSection">></a></div>
                
                </div> 
                <div id="addressSection">
            <div class="form-group row mt-4">
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
            </div></div>
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">Godziny otwarcia</div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="openSection">></a></div>
                </div> 
            <div id="openSection">
            <div class="form-group row mt-4">
                <label for="monday" class="col-md-4 col-form-label text-md-right">Poniedziałek</label>

                <div class="col-md-6">
                    <input id="monday" type="text" class="form-control @error('monday') is-invalid @enderror" name="monday" value="{{ old('monday') }}" placeholder="zamknięte">

                    @error('monday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tuesday" class="col-md-4 col-form-label text-md-right">Wtorek</label>

                <div class="col-md-6">
                    <input id="tuesday" type="text" class="form-control @error('tuesday') is-invalid @enderror" name="tuesday" value="{{ old('tuesday') }}" placeholder="zamknięte">

                    @error('tuesday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="wednesday" class="col-md-4 col-form-label text-md-right">Środa</label>

                <div class="col-md-6">
                    <input id="wednesday" type="text" class="form-control @error('wednesday') is-invalid @enderror" name="wednesday" value="{{ old('wednesday') }}" placeholder="zamknięte">

                    @error('wednesday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="thursday" class="col-md-4 col-form-label text-md-right">Czwartek</label>

                <div class="col-md-6">
                    <input id="thursday" type="text" class="form-control @error('thursday') is-invalid @enderror" name="thursday" value="{{ old('thursday') }}" placeholder="zamknięte">

                    @error('thursday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="friday" class="col-md-4 col-form-label text-md-right">Piątek</label>

                <div class="col-md-6">
                    <input id="friday" type="text" class="form-control @error('friday') is-invalid @enderror" name="friday" value="{{ old('friday') }}" placeholder="zamknięte">

                    @error('friday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="saturday" class="col-md-4 col-form-label text-md-right">Sobota</label>

                <div class="col-md-6">
                    <input id="saturday" type="text" class="form-control @error('saturday') is-invalid @enderror" name="saturday" value="{{ old('saturday') }}" placeholder="zamknięte">

                    @error('saturday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="sunday" class="col-md-4 col-form-label text-md-right">Niedziela</label>

                <div class="col-md-6">
                    <input id="sunday" type="text" class="form-control @error('sunday') is-invalid @enderror" name="sunday" value="{{ old('sunday') }}" placeholder="zamknięte">

                    @error('sunday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

        </div> </div> 
            <div class="row section">
                <div class="sectionTittle">
                    <div class="textTittle">Często zadawane pytania i odpowiedzi </div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="qandaSection">></a></div>
                
                </div> 
            <div id="qandaSection">
            <div id="questions" class="mt-3">

            </div>
            <a class="btn-primary p-2" onClick="questions()">Dodaj pytanie</a>
            </div> </div> </div>
            <hr>
            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Zdjęcia lokalu</label>

                <div class="col-md-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                    
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            
            <input type="hidden" name="type" value="{{$selectCategory}}" require>
            <div class="row mt-5">
                <button class="btn-primary p-2">Dodaj usługę</button>
            </div>
        </form>
    </div>

    
</div>
@endsection

@push('business')
    <script>
        var checkboxN = 0;
        var serviceN = 0;
        var qaN = 0;
        function questions()
        {
            qa = document.getElementById("questions");
            //create div 
            var divForm = document.createElement('div');
            divForm.classList.add("form-group");
            divForm.classList.add("row");
            qa.appendChild(divForm);
            //create label
            var label = document.createElement('label');
            label.htmlFor = "id" + qaN;
            label.classList.add("col-md-4");
            label.classList.add("col-form-label");
            label.classList.add("text-md-right");
            label.appendChild(document.createTextNode("Pytanie"));
            divForm.appendChild(label);
            //create div for input
            var divInput = document.createElement('div');
            divInput.classList.add("col-md-6");
            divForm.appendChild(divInput);
            //creat input
            var input = document.createElement('input');
            input.type = "text";
            input.name = "question[]";
            input.id = "id" + qaN;
            input.classList.add("form-control");
            divInput.appendChild(input);
            qaN++;
            //create div 
            var divForm = document.createElement('div');
            divForm.classList.add("form-group");
            divForm.classList.add("row");
            qa.appendChild(divForm);
            //create label
            var label = document.createElement('label');
            label.htmlFor = "id" + qaN;
            label.classList.add("col-md-4");
            label.classList.add("col-form-label");
            label.classList.add("text-md-right");
            label.appendChild(document.createTextNode("Odpowiedź"));
            divForm.appendChild(label);
            //create div for input
            var divInput = document.createElement('div');
            divInput.classList.add("col-md-6");
            divForm.appendChild(divInput);
            //creat input
            var input = document.createElement('input');
            input.type = "text";
            input.name = "answer[]";
            input.id = "id" + qaN;
            input.classList.add("form-control");
            divInput.appendChild(input);
            var hr = document.createElement('hr');
            qa.appendChild(hr);
            qaN++;
            
        }
        function addService()
        {
            service = document.getElementById("service");
            
            var data = ['Cena od', 'Cena do', 'Jednostka', 'Tytuł', 'Opis', 'Minimalna ilość osób', 'Maksymalna ilość osób', 'Wielkość [m^2]'];
            var name = ['priceFrom', 'priceTo', 'unit', 'titleService', 'descriptionService', 'minPeople', 'maxPeople', 'sizeService'];
            var type = ['number', 'number', 'text', 'text', 'text', 'number', 'number', 'number'];
            for(var i=0; i<data.length; i++)
            {
                //create div 
                var divForm = document.createElement('div');
                divForm.classList.add("form-group");
                divForm.classList.add("row");
                service.appendChild(divForm);
                //create label
                var label = document.createElement('label');
                label.htmlFor = "id" + serviceN;
                label.classList.add("col-md-4");
                label.classList.add("col-form-label");
                label.classList.add("text-md-right");
                label.appendChild(document.createTextNode(data[i]));
                divForm.appendChild(label);
                //create div for input
                var divInput = document.createElement('div');
                divInput.classList.add("col-md-6");
                divForm.appendChild(divInput);
                //creat input
                var input = document.createElement('input');
                input.type = type[i];
                input.name = name[i] + "[]";
                input.value = "{{ old('"+ name[i] +"') }}";
                input.id = "id" + serviceN;
                input.classList.add("form-control");
                divInput.appendChild(input);
                serviceN++;
            }
            //create files
            
            //create div 
            var divForm = document.createElement('div');
            divForm.classList.add("form-group");
            divForm.classList.add("row");
            service.appendChild(divForm);
            //create label
            var label = document.createElement('label');
            label.htmlFor = "id" + serviceN;
            label.classList.add("col-md-4");
            label.classList.add("col-form-label");
            label.classList.add("text-md-right");
            label.appendChild(document.createTextNode('Zdjęcia sali'));
            divForm.appendChild(label);
            //create div for input
            var divInput = document.createElement('div');
            divInput.classList.add("col-md-6");
            divForm.appendChild(divInput);
            //creat input files
            var input = document.createElement('input');
            input.type = "file";
            input.name = 'imageService[]';
            input.id = "id" + serviceN;
            input.multiple = true;  
            input.classList.add("form-control");
            divInput.appendChild(input);
            serviceN++;
            var hr = document.createElement('hr');
            service.appendChild(hr);
        }
        function addCategory()
        {
            var category = document.getElementById('userInputCategory').value;
            var myDiv = document.getElementById("userCategory");
             
            var divForm = document.createElement('div');
            divForm.classList.add("form-check");
            // creating checkbox element
            var checkbox = document.createElement('input');
             
            // Assigning the attributes
            // to created checkbox
            checkbox.type = "checkbox";
            checkbox.name = "user[]";
            checkbox.value = category;
            checkbox.id = "id" + checkboxN;
            checkbox.classList.add("form-check-input");
             
            // creating label for checkbox
            var label = document.createElement('label');
             
            // assigning attributes for
            // the created label tag
            label.htmlFor = "id" + checkboxN;
            label.classList.add("form-check-label");
            label.classList.add("mr-4");
            // appending the created text to
            // the created label tag
            label.appendChild(document.createTextNode(category));
             
            // appending the checkbox
            // and label to div
            if(category.length > 0)
            {
                myDiv.appendChild(divForm);
                divForm.appendChild(label);
                divForm.appendChild(checkbox);
                
                document.getElementById('userInputCategory').value = '';
                checkboxN++;
            }
        }
        $('.showSection').on('click', function () {
   
        var name = "#" + $(this).attr("data-name");
            if($(name).is(":visible"))
            {
                $( name  ).slideUp(800);
            }
            else
            {
                $( name  ).slideDown(800);
            }
        
        });
        $(document).ready(function(){
            $('#modalBeds').hide();
        $('input[type="checkbox"]').click(function(){
            if($(this).val() == 14){
                if($(this).prop("checked") == true){
                    $('#modalBeds').show();
                }
                else if($(this).prop("checked") == false){
                    $('#modalBeds').hide();
                }
        }
        });
    });
    </script>
@endpush