@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="row section">
        <form method="POST" action="{{ route('addService') }}" enctype="multipart/form-data">
                              @csrf
                <div class="sectionTittle">
                    <div class="textTittle mb-2">
                        Nowa oferta
                    </div>

                </div> 
                <div id="serviceSection">
        

            <div class="form-group row">
                <label for="titleService" class="col-md-4 col-form-label text-md-right">Tytuł</label>

                <div class="col-md-6">
                    <input id="titleService" type="text" maxlength="50" class="form-control @error('titleService') is-invalid @enderror" name="title" value="{{ old('titleService') }}" required>

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
                    <textarea id="descriptionService" type="text" maxlength="1000" class="form-control @error('descriptionService') is-invalid @enderror" name="description" value="{{ old('descriptionService') }}"></textarea>

                    @error('descriptionService')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mt-4">
                <label for="priceFrom" class="col-md-4 col-form-label text-md-right">Cena od</label>

                <div class="col-md-6">
                    <input id="priceFrom" type="number" min="0" max="1000000" class="form-control @error('priceFrom') is-invalid @enderror" name="priceFrom" value="{{ old('priceFrom') }}" required>

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
                    <input id="priceTo" type="number" min="0" max="1000000" class="form-control @error('priceTo') is-invalid @enderror" name="priceTo" value="{{ old('priceTo') }}" required>

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
                    <input id="unit" type="text" maxlength="30" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ old('unit') }}" placeholder="osoba, 1h, doba itp." required>

                    @error('unit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            
            <div class="form-group row">
                <label for="minPeople" class="col-md-4 col-form-label text-md-right">
                @if($business->name_category == "lokal")
                    Minimalna ilość osób
                @elseif($business->name_category == "music" || $business->name_category == "photo")
                    Osób w zespole od
                @endif
                </label>

                <div class="col-md-6">
                    <input id="minPeople" type="number" min="0" max="1000000" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople" value="{{ old('minPeople') }}" required>

                    @error('minPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="maxPeople" class="col-md-4 col-form-label text-md-right">
                    @if($business->name_category == "lokal")
                        Maksymalna ilość osób
                    @elseif($business->name_category == "music" || $business->name_category == "photo")
                        Osób w zespole do
                    @endif
                </label>

                <div class="col-md-6">
                    <input id="maxPeople" type="number" min="0" max="1000000" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople" value="{{ old('maxPeople') }}" required>

                    @error('maxPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            @if($business->name_category == "lokal")
            <div class="form-group row">
                <label for="sizeService" class="col-md-4 col-form-label text-md-right">Wielkość [m^2]</label>

                <div class="col-md-6">
                    <input id="sizeService" type="number" min="0" max="1000000" class="form-control @error('sizeService') is-invalid @enderror" name="size" value="{{ old('sizeService') }}" required>

                    @error('sizeService')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @endif
            <div class="form-group row" style="padding-left:20px!important;">
                <label for="image" class="col-md-4 col-form-label text-md-right">
                    @if($business->name_category == "local")
                        Zdjęcia sali
                    @elseif($business->name_category == "music" || $business->name_category == "photo")
                        Zdjęcia związane z usługą
                    @endif
                </label>

                <div class="col-md-6">
                    <input id="inputService" type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                   
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div id="previewService" class="mt-2"></div>
            </div>
            <button class="btn btn-primary mt-3" style="margin-left:43%;">Dodaj ofertę</button>
</form>
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#servicePreview").addClass("active");

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
            image.classList.add("border");
            image.classList.add("mb-2");
            preview.appendChild(image);
         });
         
         reader.readAsDataURL(file);
      
      }

   }

   document.querySelector('#inputService').addEventListener("change", previewImages2);
</script>
@endpush