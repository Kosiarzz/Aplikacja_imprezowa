@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <form method="POST" action="{{ route('addEvent') }}">
         @csrf
         <div class="form-group row">
            <div class="col-md-12 mb-2">Wybierz rodzaj wydarzenia</div>
            @foreach($categories as $cParty) 
                @foreach($cParty->groupCategory as $gPartyCategory) 
                    @foreach($gPartyCategory->category as $partyCategory) 
                        <div class="form-check">
                            <div class="inputGroup">
                                <input id="{{$partyCategory->name}}" name="party" type="radio" value="{{$partyCategory->id}}"/>
                                <label for="{{$partyCategory->name}}">{{$partyCategory->name}}</label>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
         </div>
         <div class="form-group row">
            <label for="name" class="col-md-6 col-form-label text-md-left">Nazwa wydarzenia</label>
            <label for="name" class="col-md-6 col-form-label text-md-right">100</label>
            <div class="col-md-12">
               <input id="name" min="3" max="20" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" require>
               @error('name')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
         </div>
         <div class="form-group row">
            <label for="budget" class="col-md-6 col-form-label text-md-left">Budżet do wykorzystania</label>
            <div class="col-md-12">
               <input id="budget" min="0" max="10000000" type="number" class="form-control @error('budget') is-invalid @enderror" name="budget" value="{{ old('budget') }}">
               @error('budget')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
         </div>
         <div class="form-group row">
            <label for="date" class="col-md-6 col-form-label text-md-left">Data wydarzenia</label>
            <div class="col-md-12">
               <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
               @error('date')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
         </div>
         <button class="btn btn-primary">Stwórz wydarzenie</button>
      </form>
   </div>
</div>
@endsection