@extends('layouts.business')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('addBusiness') }}" enctype="multipart/form-data">
            @csrf
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

            <div class="form-group">
                <label for="select" class="col-lg-4 control-label">Rodzaj budynku</label>
                <div class="col-lg-6">
                    <select name="mainCategory" class="form-control" id="select">
                        @foreach($category as $cate)
                            @if($cate->type == 'lokal')
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-12 mb-2">Obsługiwane imprezy</div>
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
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12 mb-2">Dodatkowe informacje</div>
                @foreach($category as $cate)
                    @if($cate->type == 'dinfo')
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$cate->name}}">
                                {{$cate->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$cate->id}}" id="{{$cate->name}}" name="dodatkowe[]">
                        </div>
                    @endif
                @endforeach
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12 mb-2">Atrakcje</div>
                
                @foreach($category as $cate)
                    @if($cate->type == 'atrakcje')
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$cate->name}}">
                                {{$cate->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$cate->id}}" id="{{$cate->name}}" name="atrakcje[]">
                        </div>
                    @endif
                @endforeach
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-md-12 mb-2">Inni użytkownicy dodali również</div>
                
                @foreach($category as $cate)
                    @if($cate->type == 'user')
                        <div class="form-check">
                            <label class="form-check-label mr-4" for="{{$cate->name}}">
                                {{$cate->name}}
                            </label>
                            <input class="form-check-input" type="checkbox" value="{{$cate->id}}" id="{{$cate->name}}" name="popular[]">
                        </div>
                    @endif
                @endforeach
                <div class="form-check">
                    <label class="form-check-label mr-4" for="test">
                        Popularne
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="test"  name="popular[]">
                </div>
            </div>
            <hr>
            <div id="userCategory" class="form-group row">
                <div class="col-md-12 mb-2">Dodaj własne kategorie</div>
                <!-- Kategorie dodane przez usera -->
            </div>
            <div class="row">
                    <input type="text" id="userInputCategory">
                    <div class="btn-info p-2 ml-2" onClick="addCategory();">Dodaj kategorie</div>
                </div>
            <hr>
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
            Wynajmowana przestrzeń
            <div class="form-group row">
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
                <label for="titleRoom" class="col-md-4 col-form-label text-md-right">Tytuł</label>

                <div class="col-md-6">
                    <input id="titleRoom" type="text" class="form-control @error('titleRoom') is-invalid @enderror" name="titleRoom[]" value="{{ old('titleRoom') }}">

                    @error('titleRoom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descriptionRoom" class="col-md-4 col-form-label text-md-right">Opis</label>

                <div class="col-md-6">
                    <input id="descriptionRoom" type="text" class="form-control @error('descriptionRoom') is-invalid @enderror" name="descriptionRoom[]" value="{{ old('descriptionRoom') }}">

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
                    <input id="minPeople" type="number" min="0" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople[]" value="{{ old('minPeople') }}">

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
                    <input id="maxPeople" type="number" min="0" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople[]" value="{{ old('maxPeople') }}">

                    @error('maxPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="sizeRoom" class="col-md-4 col-form-label text-md-right">Wielkość [m^2]</label>

                <div class="col-md-6">
                    <input id="sizeRoom" type="number" min="0" class="form-control @error('sizeRoom') is-invalid @enderror" name="sizeRoom[]" value="{{ old('sizeRoom') }}">

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
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="imageRoom[]" multiple>
                   
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div id="room"></div>
            <a class="btn-primary p-2" onClick="addRoom()">Dodaj sale</a>
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
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                    
                    @error('image')
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
            Często zadawane pytania i odpowiedzi 
            <div id="questions" class="mt-3">

            </div>
            <a class="btn-primary p-2" onClick="questions()">Dodaj pytanie</a>
            <div class="row mt-5 text-md-right">
                <button>Dodaj usługę</button>
            </div>
        </form>
    </div>

    
</div>
@endsection

@push('business')
    <script>

        var checkboxN = 0;
        var roomN = 0;
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

        function addRoom()
        {
            room = document.getElementById("room");
            
            var data = ['Cena od', 'Cena do', 'Jednostka', 'Tytuł', 'Opis', 'Minimalna ilość osób', 'Maksymalna ilość osób', 'Wielkość [m^2]'];
            var name = ['priceFrom', 'priceTo', 'unit', 'titleRoom', 'descriptionRoom', 'minPeople', 'maxPeople', 'sizeRoom'];
            var type = ['number', 'number', 'text', 'text', 'text', 'number', 'number', 'number'];

            for(var i=0; i<data.length; i++)
            {
                //create div 
                var divForm = document.createElement('div');
                divForm.classList.add("form-group");
                divForm.classList.add("row");
                room.appendChild(divForm);

                //create label
                var label = document.createElement('label');
                label.htmlFor = "id" + roomN;
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
                input.id = "id" + roomN;
                input.classList.add("form-control");
                divInput.appendChild(input);

                roomN++;
            }

            //create files
            
            //create div 
            var divForm = document.createElement('div');
            divForm.classList.add("form-group");
            divForm.classList.add("row");
            room.appendChild(divForm);

            //create label
            var label = document.createElement('label');
            label.htmlFor = "id" + roomN;
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
            input.name = 'imageRoom[]';
            input.id = "id" + roomN;
            input.multiple = true;  
            input.classList.add("form-control");
            divInput.appendChild(input);

            roomN++;

            var hr = document.createElement('hr');
            room.appendChild(hr);
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
    </script>
@endpush
