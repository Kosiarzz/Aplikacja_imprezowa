@extends('layouts.service')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="row section">
        <form method="POST" action="{{ route('addService') }}" enctype="multipart/form-data">
                @csrf
                <div class="sectionTittle">
                    <div class="textTittle">
                        
                        @if($business->name_category == "lokal")
                            Wynajmowana przestrzeń
                        @elseif($business->name_category == "music" || $business->name_category == "photo")
                            Oferowana usługa
                        @endif
                    </div>
                    <div class="showSectionButton"><a class="btn btn-info showSection" data-name="serviceSection">></a></div>
                
                </div> 
                <div id="serviceSection">
            
            <div class="form-group row mt-4">
                <label for="priceFrom" class="col-md-4 col-form-label text-md-right">Cena od</label>

                <div class="col-md-6">
                    <input id="priceFrom" type="number" min="0" class="form-control @error('priceFrom') is-invalid @enderror" name="priceFrom" value="{{ $business->services[0]->price_from }}">

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
                    <input id="priceTo" type="number" min="0" class="form-control @error('priceTo') is-invalid @enderror" name="priceTo" value="{{ $business->services[0]->price_to }}">

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
                    <input id="unit" type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" value="{{ $business->services[0]->unit }}" placeholder="osoba, 1h, doba itp.">

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
                    <input id="titleService" type="text" class="form-control @error('titleService') is-invalid @enderror" name="title" value="{{ $business->services[0]->title }}">

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
                    <input id="descriptionService" type="text" class="form-control @error('descriptionService') is-invalid @enderror" name="description" value="{{ $business->services[0]->description }}">

                    @error('descriptionService')
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
                    Ilość osób w zespole
                @endif
                </label>

                <div class="col-md-6">
                    <input id="minPeople" type="number" min="0" class="form-control @error('minPeople') is-invalid @enderror" name="minPeople" value="{{ $business->services[0]->people_from }}">

                    @error('minPeople')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @if($business->name_category == "lokal")
            <div class="form-group row">
                <label for="maxPeople" class="col-md-4 col-form-label text-md-right">Maksymalna ilość osób</label>

                <div class="col-md-6">
                    <input id="maxPeople" type="number" min="0" class="form-control @error('maxPeople') is-invalid @enderror" name="maxPeople" value="{{ $business->services[0]->people_to }}">

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
                    <input id="sizeService" type="number" min="0" class="form-control @error('sizeService') is-invalid @enderror" name="size" value="{{ $business->services[0]->size }}">

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
                    @if($business->name_category == "local")
                        Zdjęcia sali
                    @elseif($business->name_category == "music" || $business->name_category == "photo")
                        Zdjęcia związane z usługą
                    @endif
                </label>

                <div class="col-md-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" multiple>
                   
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button>Dodaj usługę</button>
</form>
    </div>
</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#servicePreview").addClass("active");
</script>
@endpush