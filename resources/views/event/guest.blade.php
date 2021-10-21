@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      Goście<br>
      <div class="row col-12">
        @foreach($guests as $guestGroup)
       
          Grupa({{$guestGroup->name}})<br>
          @foreach($guestGroup->guests as $guest)
            <div class="col-12 border">
              {{$guest->name}} |
              {{$guest->surname}} |
              {{$guest->invitation}} |
              {{$guest->confirmation}} |    
              {{$guest->accommodation}} |
              {{$guest->diet}} |
              {{$guest->transport}} |
              {{$guest->note}}
            </div>
          @endforeach
          <form method="POST" action="{{ route('addGuest') }}" class="row col-12">
            @csrf
            <div class="form-group row mr-3 mt-3">
                <label for="name" class="col-md-6 col-form-label text-md-right">Imie i nazwisko</label>

                <div class="col-md-6">
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$guestGroup->id}}" required>
            <button class="btn-primary mt-4" style="height:30px;">Dodaj gościa</button>
          </form>
          <hr>
        @endforeach
        <hr>
        <form method="POST" action="{{ route('addGroup') }}" class="row col-12">
            @csrf
            <div class="form-group row mr-3 mt-3">
                <label for="group" class="col-md-6 col-form-label text-md-right">Nazwa grupy</label>

                <div class="col-md-6">
                    <input id="group" type="group" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ old('group') }}" required>

                    @error('group')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="guest" required>
            <button class="btn-primary mt-4" style="height:30px;">Dodaj grupe</button>
          </form>
      </div>

      Podsumowanie: liczba osób/dane z listy(zaporsznie, zaakceptowane, ile dorosłych, dzieci), transport, dieta
      export do pdf 
    </div>
</div>
@endsection
