@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      Finanse<br>
      <div class="row col-12 border">
        @foreach($finances as $finance)
          Grupa({{$finance->name}})<br>
          @foreach($finance->costs as $cost)
            <div class="col-12 border">
              {{$cost->name}} |
              {{$cost->note}} |
              {{$cost->cost}}zł |
              {{$cost->quantity}} |
              {{$cost->advance}} |
              {{$cost->date_payment}} |
              {{$cost->status}}
            </div>
          @endforeach

          <form method="POST" action="{{ route('addFinance') }}" class="row col-12">
            @csrf
            <div class="form-group row mr-3 mt-3">
                <label for="name" class="col-md-6 col-form-label text-md-right">Nazwa</label>

                <div class="col-md-6">
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$finance->id}}" required>
            <button class="btn-primary mt-4" style="height:30px;">Dodaj</button>
          </form>
          <hr>
        @endforeach
      </div>
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
            <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="cost" required>
            <button class="btn-primary mt-4" style="height:30px;">Dodaj grupe</button>
          </form>
      </div>
    </div>
</div>
@endsection
