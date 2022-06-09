@extends('layouts.business')
@section('content')
<div class="container w-100">
   <div class="row justify-content-center">
      <form method="POST" action="{{ route('addBusiness') }}" enctype="multipart/form-data">
         @csrf
         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle">
                    @if($selectCategory == "room")
                        Rodzaj budynku
                    @else
                        Rodzaj usługi
                    @endif
               </div>
               <div class="showSectionButton"><a class="showSection" data-name="mainCategorySection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="mainCategorySection" class="sectionBorder">
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
            </div>
         </div>
         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle">Informacje o ogłoszeniu </div>
               <div class="showSectionButton"><a class="showSection" data-name="informationSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="informationSection" class="sectionBorder">
               <div class="form-group row">
                  <label for="title" class="col-md-6 col-form-label text-md-left">Tytuł ogłoszenia</label>
                  <label id="titleLabel" for="title" class="col-md-6 col-form-label text-md-right">100</label>
                  <div class="col-md-12">
                     <input id="title" type="text" maxlength="100" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                     @error('title')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="shortDescription" class="col-md-10 col-form-label text-md-left">Opis wyświetlany na liście wyszukiwania</label>
                  <label id="shortDescriptionLabel" for="shortDescriptionLabel" class="col-md-2 col-form-label text-md-right">200</label>
                  <div class="col-md-12">
                    <textarea id="shortDescription" maxlength="200" type="text" class="form-control @error('shortDescription') is-invalid @enderror" name="shortDescription" value="{{ old('shortDescription') }}" required></textarea>
                     @error('shortDescription')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="description" class="col-md-6 col-form-label text-md-left">Pełny opis</label>
                  <label id="descriptionLabel" for="descriptionLabel" class="col-md-6 col-form-label text-md-right">2000</label>
                  <div class="col-md-12">
                     <textarea id="description"  maxlength="2000" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required></textarea>
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
               <div class="showSectionButton"><a class="showSection" data-name="categorySection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="categorySection" class="sectionBorder">
               <div class="form-group row">
                  <div class="col-md-12 mb-2 mt-2">Obsługiwane imprezy</div>
                  @foreach($categoryParty as $cParty) 
                    @foreach($cParty->groupCategory as $gPartyCategory) 
                        @foreach($gPartyCategory->category as $partyCategory) 
                            <div class="form-check">
                                <div class="inputGroup">
                                    <input id="{{$partyCategory->name}}" name="party[]" type="checkbox" value="{{$partyCategory->id}}"/>
                                    <label for="{{$partyCategory->name}}">{{$partyCategory->name}}</label>
                                </div>
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
                                <div class="inputGroup inputGroupAdditional">
                                    <input id="{{$additionalCategory->name}}" name="additional[]" type="checkbox" value="{{$additionalCategory->id}}"/>
                                    <label for="{{$additionalCategory->name}}">{{$additionalCategory->name}}</label>
                                </div>
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
                            <div class="inputGroup inputGroupPopular">
                                <input id="{{$categoryUser->category->name}}" name="popular[]" type="checkbox" value="{{$categoryUser->category->id}}" id="{{$categoryUser->category->name}}"/>
                                <label for="{{$categoryUser->category->name}}">{{$categoryUser->category->name}}</label>
                            </div>
                        </div>
                  @endforeach
               </div>
               <hr>
               <div id="userCategory" class="form-group row">
                  <div class="col-md-12 mb-2">Dodaj własne kategorie</div>
                  <!-- Kategorie dodane przez usera -->
               </div>
               <div class="row justify-content-center">
                  <input type="text" maxlength="30" id="userInputCategory">
                  <div class="btn-info p-2 ml-2" onClick="addCategory();">Dodaj kategorie</div>
               </div>
              
            </div>
         </div>
         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle">
                  Oferta
               </div>
               <div class="showSectionButton"><a class="showSection" data-name="serviceSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            
            <div id="serviceSection" class="sectionBorder">
            <!--<div class="mt-2 p-0">#1</div>-->
               <div class="form-group row">
                  <label for="titleService" class="col-md-6 col-form-label text-md-left">Tytuł oferty</label>
                  <div class="col-md-12">
                     <input id="titleService" maxlength="50" type="text" class="form-control @error('titleService') is-invalid @enderror" name="titleService" value="{{ old('titleService') }}" required>
                     @error('titleService')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="form-group row">
                  <label for="descriptionService" class="col-md-6 col-form-label text-md-left">Opis oferty</label>
                  <div class="col-md-12">
                     <textarea id="descriptionService" type="text" maxlength="1000" class="form-control @error('descriptionService') is-invalid @enderror" name="descriptionService" value="{{ old('descriptionService') }}" required></textarea>
                     @error('descriptionService')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>

               <div class="form-group row mt-4">
                  <label for="priceFrom" class="col-md-4 col-form-label">Cena od</label>
                  <div class="col-md-12">
                     <input id="priceFrom" type="number" min="0" max="1000000" class="form-control @error('priceFrom') is-invalid @enderror" name="priceFrom" value="{{ old('priceFrom') }}" required>
                     @error('priceFrom')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  
               </div>
               <div class="form-group row">
                <label for="priceTo" class="col-md-4 col-form-label">Cena do</label>
                  <div class="col-md-12">
                     <input id="priceTo" type="number" min="0" max="1000000" class="form-control @error('priceTo') is-invalid @enderror" name="priceTo" value="{{ old('priceTo') }}" required>
                     @error('priceTo')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="unit" class="col-md-4 col-form-label">Jednostka</label>
                  <div class="col-md-12">
                     <input id="unit" type="text" maxlength="30" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="za osobę, za godzinę itp." required>
                     @error('unit')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="minPeople" class="col-md-4 col-form-label">
                  @if($selectCategory == "room")
                  Minimalna ilość osób
                  @else
                  Minimalna ilość osób w zespole
                  @endif
                  </label>
                  <div class="col-md-12">
                     <input id="minPeople" type="number" min="0" max="1000000" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople" value="{{ old('minPeople') }}" required>
                     @error('minPeople')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               
               <div class="form-group row">
                  <label for="maxPeople" class="col-md-4 col-form-label"> 
                  @if($selectCategory == "room")
                     Maksymalna ilość osób
                  @else
                     Maksymalna ilość osób w zespole
                  @endif</label>
                  <div class="col-md-12">
                     <input id="maxPeople" type="number" min="0" max="1000000" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople" value="{{ old('maxPeople') }}" required>
                     @error('maxPeople')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               @if($selectCategory == "room")
               <div class="form-group row">
                  <label for="sizeService" class="col-md-4 col-form-label">Wielkość w m<sup>2</sup></label>
                  <div class="col-md-12">
                     <input id="sizeService" type="number" min="0" max="999999" class="form-control @error('sizeService') is-invalid @enderror" name="sizeService" value="{{ old('sizeService') }}" required>
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
                     <input id="file-input" type="file" class="form-control @error('image') is-invalid @enderror" name="imageService[]" multiple>
                     @error('image')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div id="preview" class="mt-2"></div>
               <!--<hr>
               <div id="service"></div>
               <a class="btn-primary p-2" onClick="addService()">Dodaj kolejną oferte</a>-->
            </div>
         </div>
         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle">Dane kontaktowe</div>
               <div class="showSectionButton"><a class="showSection" data-name="contactSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="contactSection" class="sectionBorder"> 
               <div class="form-group row mt-4">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Imie</label>
                  <div class="col-md-6">
                     <input id="name" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $profile->contactable[0]->name }}" required>
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
                     <input id="surname" type="text" maxlength="100" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') ?? $profile->contactable[0]->surname }}" required>
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
                     <input id="businessName" type="text" maxlength="100" class="form-control @error('businessName') is-invalid @enderror" name="businessName" value="{{ old('businessName') }}" required>
                     @error('businessName')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="phone" class="col-md-4 col-form-label text-md-right">Numer telefonu</label>
                  <div class="col-md-6">
                     <input id="phone" type="text" maxlength="9" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $profile->contactable[0]->phone }}" required>
                     @error('phone')
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
               <div class="textTittle"> Media społecznościowe</div>
               <div class="showSectionButton"><a class="showSection" data-name="socialSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="socialSection" class="sectionBorder">
               <div class="form-group row mt-4">
                  <label for="www" class="col-md-4 col-form-label text-md-right">Link do strony wwww</label>
                  <div class="col-md-6">
                     <input id="www" type="text" maxlength="300" class="form-control @error('www') is-invalid @enderror" name="www" value="{{ old('www') }}">
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
                     <input id="facebook" type="text" maxlength="300" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook') }}">
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
                     <input id="instagram" type="text" maxlength="300" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram') }}">
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
                     <input id="youtube" type="text" maxlength="300" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ old('youtube') }}">
                     @error('youtube')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <!--
               <div class="form-group row">
                  <label for="youtubeMovie" class="col-md-4 col-form-label text-md-right">Link do promującego filmu na youtube</label>
                  <div class="col-md-6">
                     <input id="youtubeMovie" type="text" maxlength="300" class="form-control @error('youtubeMovie') is-invalid @enderror" name="youtubeMovie" value="{{ old('youtubeMovie') }}">
                     @error('youtubeMovie')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
            -->
            </div>
         </div>
         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle"> Adres firmy</div>
               <div class="showSectionButton"><a class="showSection" data-name="addressSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="addressSection" class="sectionBorder">
               <div class="form-group row mt-4">
                  <label for="city" class="col-md-4 col-form-label text-md-right">Miasto</label>
                  <div class="col-md-6">
                     <input id="city" type="text" maxlength="100" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>
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
                     <input id="street" type="text" maxlength="300" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required>
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
                     <input id="postCode" type="text" maxlength="6" class="form-control @error('postCode') is-invalid @enderror" name="postCode" value="{{ old('postCode') }}" required>
                     @error('postCode')
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
               <div class="textTittle">Godziny otwarcia</div>
               <div class="showSectionButton"><a class="showSection" data-name="openSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="openSection" class="sectionBorder">
               <div class="form-group row mt-4 mb-1">
                  <label for="Monday" class="col-md-4 col-form-label text-md-right">Poniedziałek</label>
                  <div class="col-md-6">
                     <input id="Monday" type="text" maxlength="15" class="form-control @error('monday') is-invalid @enderror" name="monday" value="{{ old('monday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeMonday" class="closeChecked" type="checkbox" name="closeMonday"> <label for="closeMonday">Zamknięte</label></div>
                     @error('monday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-1">
                  <label for="Tuesday" class="col-md-4 col-form-label text-md-right">Wtorek</label>
                  <div class="col-md-6">
                     <input id="Tuesday" type="text" maxlength="15" class="form-control @error('tuesday') is-invalid @enderror" name="tuesday" value="{{ old('tuesday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeTuesday" class="closeChecked" type="checkbox" name="closeTuesday"> <label for="closeTuesday">Zamknięte</label></div>
                     @error('tuesday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-1">
                  <label for="Wednesday" class="col-md-4 col-form-label text-md-right">Środa</label>
                  <div class="col-md-6">
                     <input id="Wednesday" type="text" maxlength="15" class="form-control @error('wednesday') is-invalid @enderror" name="wednesday" value="{{ old('wednesday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeWednesday" class="closeChecked" type="checkbox" name="closeWednesday"> <label for="closeWednesday">Zamknięte</label></div>
                     @error('wednesday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-1">
                  <label for="Thursday" class="col-md-4 col-form-label text-md-right">Czwartek</label>
                  <div class="col-md-6">
                     <input id="Thursday" type="text" maxlength="15" class="form-control @error('thursday') is-invalid @enderror" name="thursday" value="{{ old('thursday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeThursday" class="closeChecked" type="checkbox" name="closeThursday"> <label for="closeThursday">Zamknięte</label></div>
                     @error('thursday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-1">
                  <label for="Friday" class="col-md-4 col-form-label text-md-right">Piątek</label>
                  <div class="col-md-6">
                     <input id="Friday" type="text" maxlength="15" class="form-control @error('friday') is-invalid @enderror" name="friday" value="{{ old('friday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeFriday" class="closeChecked" type="checkbox" name="closeFriday"> <label for="closeFriday">Zamknięte</label></div>
                     @error('friday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-1">
                  <label for="Saturday" class="col-md-4 col-form-label text-md-right">Sobota</label>
                  <div class="col-md-6">
                     <input id="Saturday" type="text" maxlength="15" class="form-control @error('saturday') is-invalid @enderror" name="saturday" value="{{ old('saturday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeSaturday" class="closeChecked" type="checkbox" name="closeSaturday"> <label for="closeSaturday">Zamknięte</label></div>
                     @error('saturday')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row mb-2">
                  <label for="Sunday" class="col-md-4 col-form-label text-md-right">Niedziela</label>
                  <div class="col-md-6">
                     <input id="Sunday" type="text" maxlength="15" class="form-control @error('sunday') is-invalid @enderror" name="sunday" value="{{ old('sunday') }}" placeholder="8:00-16:00" required>
                     <div class="mt-1 p-0"><input id="closeSunday" class="closeChecked" type="checkbox" name="closeSunday"> <label for="closeSunday">Zamknięte</label></div>
                     @error('sunday')
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
               <div class="textTittle">Często zadawane pytania i odpowiedzi </div>
               <div class="showSectionButton"><a class="showSection" data-name="qandaSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="qandaSection" class="sectionBorder">
               <div id="questions" class="mt-3">
               <div class="form-group row">
                  <label for="id0" class="col-md-4 col-form-label text-md-right">Pytanie</label>
                  <div class="col-md-6"><input type="text" maxlength="150" name="question[]" id="id0" class="form-control"></div>
               </div>
               <div class="form-group row">
                  <label for="id3" class="col-md-4 col-form-label text-md-right">Odpowiedź</label>
                  <div class="col-md-6"><input type="text" maxlength="300" name="answer[]" id="id3" class="form-control"></div>
               </div>
               </div>
               <hr>
               <a class="btn-primary p-2" onClick="questions()">Dodaj pytanie</a>
            </div>
         </div>

         <div class="row section">
            <div class="sectionTittle">
               <div class="textTittle">Zdjęcia związane z usługą</div>
               <div class="showSectionButton"><a class="showSection" data-name="photoSection"><i class="fas fa-compress-alt"></i></a></div>
            </div>
            <div id="photoSection" class="sectionBorder">
               <div class="col-md-6 mt-3">
                  <input id="inputService" type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                  @error('image')
                  <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div id="previewService" class="mt-2"></div>
            </div>
         </div>
   </div>
   <input type="hidden" name="type" value="{{$selectCategory}}" required>
   <div class="row mt-3 mb-4">
      <button class="btn btn-primary p-2" style="margin-left:43%; width:170px; height:50px; font-size:18px;">Dodaj usługę</button>
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
   var serviceNumber = 2;

   function questions()
   {
       qa = document.getElementById("questions");
       var hr = document.createElement('hr');
       qa.appendChild(hr);

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

       qaN++;
       
   }
   function addService()
   {
      service = document.getElementById("service");
      serviceID = document.createElement('div');
      serviceID.id = "service"+serviceNumber;
      service.appendChild(serviceID);

      var divForm = document.createElement('div');
      divForm.classList.add("form-group");
      divForm.classList.add("row");
      divForm.classList.add("mt-2");
      serviceID.appendChild(divForm);


      number = document.createElement('div');
      number.classList.add("col-md-6");
      number.classList.add("text-md-left");
      number.innerHTML = "#"+serviceNumber;
      divForm.appendChild(number);

      deleteDiv = document.createElement('div');
      deleteDiv.classList.add("col-md-6");
      deleteDiv.classList.add("text-md-right");
      divForm.appendChild(deleteDiv);

      deleteButton = document.createElement('div');
      deleteButton.classList.add("deleteService");
      deleteButton.classList.add("btn");
      deleteButton.classList.add("btn-danger");
      deleteButton.innerHTML = "Usuń ofertę #"+serviceNumber;

      deleteDiv.appendChild(deleteButton);

      serviceNumber++;

      var data = ['Tytuł oferty', 'Opis', 'Cena od', 'Cena do', 'Jednostka', 'Minimalna ilość osób', 'Maksymalna ilość osób', 'Wielkość [m^2]'];
      var name = ['titleService', 'descriptionService', 'priceFrom', 'priceTo', 'unit',  'minPeople', 'maxPeople', 'sizeService'];
      var type = ['text', 'text', 'number', 'number', 'text', 'number', 'number', 'number'];

       for(var i=0; i<data.length; i++)
       {
           //create div 
           var divForm = document.createElement('div');
           divForm.classList.add("form-group");
           divForm.classList.add("row");
           divForm.classList.add("mt-2");
           serviceID.appendChild(divForm);
           //create label
           var label = document.createElement('label');
           label.htmlFor = "id" + serviceN;
           label.classList.add("col-md-6");
           label.classList.add("col-form-label");
           label.classList.add("text-md-left");
           label.appendChild(document.createTextNode(data[i]));
           divForm.appendChild(label);
           //create div for input
           var divInput = document.createElement('div');
           divInput.classList.add("col-md-12");
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
       serviceID.appendChild(divForm);
       //create label
       var label = document.createElement('label');
       label.htmlFor = "id" + serviceN;
       label.classList.add("col-md-4");
       label.classList.add("col-form-label");
       label.classList.add("text-md-right");
       label.appendChild(document.createTextNode('Zdjęcia związane z ofertą'));
       divForm.appendChild(label);
       //create div for input
       var divInput = document.createElement('div');
       divInput.classList.add("col-md-6");
       divForm.appendChild(divInput);
       //creat input files
       var input = document.createElement('input');
       input.type = "file";
       input.name = 'imageService[]';
       input.id = "file-input" + serviceN;
       input.multiple = true;  
       input.classList.add("form-control");
       divInput.appendChild(input);
       

       var divPreview = document.createElement('div');
       divPreview.id = "preview" + serviceN;
       divPreview.classList.add("col-md-12");
       serviceID.appendChild(divPreview);

       
       var hr = document.createElement('hr');
       serviceID.appendChild(hr);

       serviceN++;
   }

   function addCategory()
   {
       var category = document.getElementById('userInputCategory').value;
       var myDiv = document.getElementById("userCategory");
        
       var divForm = document.createElement('div');
       divForm.classList.add("form-check");

       var divGroup = document.createElement('div');
       divGroup.classList.add("inputGroup");
       divGroup.classList.add("inputGroupUser");

       // creating checkbox element
       var checkbox = document.createElement('input');
        
       // Assigning the attributes
       // to created checkbox
       checkbox.type = "checkbox";
       checkbox.name = "user[]";
       checkbox.value = category;
       checkbox.id = "id" + checkboxN;
       checkbox.checked = true;

       // creating label for checkbox
       var label = document.createElement('label');
        
       // assigning attributes for
       // the created label tag
       label.htmlFor = "id" + checkboxN;
       // appending the created text to
       // the created label tag
       label.appendChild(document.createTextNode(category));
        
       // appending the checkbox
       // and label to div
       if(category.length > 0)
       {
           myDiv.appendChild(divForm);
           divForm.appendChild(divGroup); 
           
           divGroup.appendChild(checkbox);
           divGroup.appendChild(label);

           document.getElementById('userInputCategory').value = '';
           checkboxN++;
       }
   }

   $(document).on('click', '.deleteService', function () {
      
      var parentTag = "#"+$( this ).parent().parent().parent().get( 0 ).id;
      console.log("DELETE SERVICE "+parentTag);
      $(parentTag).remove();
   });

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

   // $(document).ready(function(){
   //      $('#modalBeds').hide();
   //  $('input[type="checkbox"]').click(function(){
   //      if($(this).val() == 14){
   //          if($(this).prop("checked") == true){
   //              $('#modalBeds').show();
   //          }
   //          else if($(this).prop("checked") == false){
   //              $('#modalBeds').hide();
   //          }
   //  }
   //  });
   // });


    var limitTitle = 100;
    var limitShortDescription = 200;
    var limitDescription = 2000;

    $('#title').keyup(function(){
        $('#titleLabel').text((limitTitle - $(this).val().length));

        if ($(this).val().length > limitTitle) {
            $(this).val($(this).val().substring(0, limitTitle));
        }
    });

    $('#shortDescription').keyup(function(){  
        $('#shortDescriptionLabel').text((limitShortDescription - $(this).val().length));

        if ($(this).val().length > limitShortDescription) {
            $(this).val($(this).val().substring(0, limitShortDescription));
        }
    });

    $('#description').keyup(function(){
        $('#descriptionLabel').text((limitDescription - $(this).val().length));

        if ($(this).val().length > limitDescription) {
            $(this).val($(this).val().substring(0, limitDescription));
        }
    });



    $('.closeChecked').on('click', function() { 
        var id = $(this).attr('id');
        var day = id.replace('close', '');

        if ($('#' + id).prop('checked')) {
            $('#' + day).prop("disabled", true);
            $('#' + day).prop("required", false);
        }
        else
        {
            $('#' + day).prop("required", true);
            $('#' + day).prop("disabled", false);
        }
    });

    function previewImages() {
      var preview = document.querySelector('#preview');

      if (this.files) {
      [].forEach.call(this.files, readAndPreview);
      }

      function readAndPreview(file) {

         // Make sure `file.name` matches our extensions criteria
         if (!/\.(jpe?g|png)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
         } // else...
         
         var reader = new FileReader();
         
         reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 150;
            image.width = 140;
            image.title  = file.name;
            image.src    = this.result;
            image.classList.add("mr-2");
            image.classList.add("mb-2");
            image.classList.add("border");
            preview.appendChild(image);
         });
         
         reader.readAsDataURL(file);
      
      }

   }

   function previewImages2() {
      var preview = document.querySelector('#previewService');

      if (this.files) {
      [].forEach.call(this.files, readAndPreview);
      }

      function readAndPreview(file) {

         // Make sure `file.name` matches our extensions criteria
         if (!/\.(jpe?g|png)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
         } // else...
         
         var reader = new FileReader();
         
         reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 150;
            image.width = 140;
            image.title  = file.name;
            image.src    = this.result;
            image.classList.add("mr-2");
            image.classList.add("mb-2");
            image.classList.add("border");
            preview.appendChild(image);
         });
         
         reader.readAsDataURL(file);
      
      }

   }

document.querySelector('#inputService').addEventListener("change", previewImages2);
document.querySelector('#file-input').addEventListener("change", previewImages);


</script>
@endpush