@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="titlePage">
         Goście
      </div>
      <div class="row col-12">
        @foreach($guests as $guestGroup)
        <div class="list-group col-12">
            <ul class="mb-0 mt-4 pb-2">
               <li class="list-group-item row nameGroupTask">
                  {{$guestGroup->name}} ({{ count($guestGroup->guests->where('status', 1)) }}/{{ count($guestGroup->guests) }})
                  <div class="float-right"> 
                     <a class="btn btn-primary dataGroup" data-toggle="modal" data-target="#exampleModalGroup" data-id="{{$guestGroup->id}}" data-name="{{$guestGroup->name}}">E</a>
                     <a class="btn btn-danger deleteGroup" data-toggle="modal" data-target="#exampleModalGroupDelete" data-id="{{$guestGroup->id}}">X</a>
                     <a class="btn btn-info showGroup" data-name="groupModal{{$guestGroup->id}}">></a>
                  </div>
               </li>
            </ul>
            <ul id="groupModal{{$guestGroup->id}}">

          @foreach($guestGroup->guests as $guest) 
            @if($guest->status == 0)
               <li class="list-group-item row task">
                  <form method="POST" action="{{ route('statusFinance') }}">
                     @csrf
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                     <button class="btn btn-warning mr-2">R</button>
                  </form>
                  @else
               <li class="list-group-item row task taskChecked">
                  <form method="POST" action="{{ route('statusFinance') }}">
                     @csrf
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="0" required>
                     <button class="btn btn-warning mr-2">U</button>
                  </form>
                  @endif
                  {{$guest->name}} 
                  <div class="float-right"> 
                     
                     <a class="btn btn-primary data" data-toggle="modal" data-target="#exampleModal" data-groupId="{{$guestGroup->id}}" data-groupName="{{$guestGroup->name}}" data-id="{{$guest->id}}" data-name="{{$guest->name}}" data-date="{{$guest->date_payment}}" data-note="{{$guest->note}}" data-cost="{{$guest->cost}}" data-count="{{$guest->quantity}}" data-advance="{{$guest->advance}}">E</a>
                     <a class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModalDelete" data-id="{{$guest->id}}">X</a>
                  </div>
               </li>
          @endforeach
          <li class="list-group-item row">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask{{$guestGroup->id}}">
                  Dodaj gościa
                  </button>
                  <div class="modal fade" id="addTask{{$guestGroup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Nowe koszty</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form method="POST" action="{{ route('addFinance') }}">
                              @csrf
                              <div class="form-group">
                                 <label for="name" class="col-md-12 col-form-label">Imie</label>
                                 <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="surname" class="col-md-12 col-form-label">Nazwisko</label>
                                 <div class="col-md-12">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Zaproszenie</label>
                              </div>
                              <div class="form-group">
                              
                                 
                                 <div class="col-md-12">
                                    <input id="cost" type="number" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}">
                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="count" class="col-md-12 col-form-label">Ilość</label>
                                 <div class="col-md-12">
                                    <input id="count" type="number" class="form-control @error('count') is-invalid @enderror" name="count" value="{{ old('count') }}">
                                    @error('count')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="advance" class="col-md-12 col-form-label">Zaliczka</label>
                                 <div class="col-md-12">
                                    <input id="advance" type="number" class="form-control @error('advance') is-invalid @enderror" name="advance" value="{{ old('advance') }}">
                                    @error('advance')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="note" class="col-md-12 col-form-label">Notatka</label>
                                 <div class="col-md-12">
                                    <textarea id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}"></textarea>
                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="date" class="col-md-12 col-form-label">Data zapłaty</label>
                                 <div class="col-md-12">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="modal-body">
                                 <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$guestGroup->id}}" required>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                                 <button type="submit" class="btn btn-primary">Dodaj gościa</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
        @endforeach
        </div>
      <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addGroup">
      Dodaj grupę
      </button>
      <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Nowa grupa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form method="POST" action="{{ route('addGroup') }}" class="row col-12">
                     @csrf
                     <div class="form-group row">
                        <label for="group" class="col-md-12 col-form-label">Nazwa grupy</label>
                        <div class="col-md-12">
                           <input id="group" type="text" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ old('group') }}" required>
                           @error('group')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="cost" required>
               </div>
               <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
               <button type="submit" class="btn btn-primary">Dodaj grupę</button>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>


<!-- Edit guest modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Koszt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('editGuest') }}">
               @csrf
               <div class="form-group">
                                 <label for="name-edit" class="col-md-12 col-form-label">Nazwa kosztów</label>
                                 <div class="col-md-12">
                                    <input id="name-edit" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="cost-edit" class="col-md-12 col-form-label">Koszt</label>
                                 <div class="col-md-12">
                                    <input id="cost-edit" type="number" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost') }}">
                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="count-edit" class="col-md-12 col-form-label">Ilość</label>
                                 <div class="col-md-12">
                                    <input id="count-edit" type="number" class="form-control @error('count') is-invalid @enderror" name="count" value="{{ old('count') }}">
                                    @error('count')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="advance-edit" class="col-md-12 col-form-label">Zaliczka</label>
                                 <div class="col-md-12">
                                    <input id="advance-edit" type="number" class="form-control @error('advance') is-invalid @enderror" name="advance" value="{{ old('advance') }}">
                                    @error('advance')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="note-edit" class="col-md-12 col-form-label">Notatka</label>
                                 <div class="col-md-12">
                                    <textarea id="note-edit" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}"></textarea>
                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="date-edit" class="col-md-12 col-form-label">Data zapłaty</label>
                                 <div class="col-md-12">
                                    <input id="date-edit" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label for="edit-group" class="col-md-12 col-form-label">Grupa</label>
                                 <div class="col-md-12">
                              <select id="edit-group" class="form-select form-control" name="group" aria-label="Default select example">
                              @foreach($guests as $guestGroup)
                                <option value="{{$guestGroup->id}}">{{$guestGroup->name}}</option>
                              @endforeach
                              </select>
</div>
</div>

               <input id="id-edit" type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{ old('id') }}" required>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete guest modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Usuwanie kosztów</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Czy chcesz usunąć tego gościa?
            <form method="POST" action="{{ route('deleteGuest') }}">
               @csrf
               <input id="id-delete" type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{ old('id') }}" required>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
         <button type="submit" class="btn btn-primary">Usuń zadanie</button>
         </div>
         </form>
      </div>
   </div>
</div>

<!-- Edit group modal -->
<div class="modal fade" id="exampleModalGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Twoja grupa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('editGroup') }}">
               @csrf
               <div class="form-group">
                  <label for="name-group-edit" class="col-md-12 col-form-label">Nazwa grupy</label>
                  <div class="col-md-12">
                     <input id="name-group-edit" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <input id="id-group-edit" type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{ old('id') }}" required>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete group modal -->
<div class="modal fade" id="exampleModalGroupDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Usuwanie grupy</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Czy chcesz usunąć grupę i wszyskie należące do niej zadania?
            <form method="POST" action="{{ route('deleteGroup') }}">
               @csrf
               <input id="id-group-delete" type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{ old('id') }}" required>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
         <button type="submit" class="btn btn-primary">Usuń Grupę</button>
         </div>
         </form>
      </div>
   </div>
</div>

@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#guest").addClass("active");

   $('.data').on('click', function () {
   
   var id = $(this).attr("data-id");
   var name = $(this).attr("data-name");
   var date = $(this).attr("data-date");
   var note = $(this).attr("data-note");
   var cost = $(this).attr("data-cost");
   var count = $(this).attr("data-count");
   var advance = $(this).attr("data-advance");
    
   var groupId = $(this).attr("data-groupId");
   var groupName = $(this).attr("data-groupName");

   $("#id-edit").val(id);
   $("#name-edit").val(name);
   $("#date-edit").val(date);
   $("#note-edit").val(note);
   $("#cost-edit").val(cost);
   $("#count-edit").val(count);
   $("#advance-edit").val(advance);

   $("#edit-group option[value=" + groupId + "]").prop("selected", true);
  });

  $('.delete').on('click', function () {

  var id = $(this).attr("data-id");

  $("#id-delete").val(id);
  });

   $('.dataGroup').on('click', function () {
   
   var id = $(this).attr("data-id");
   var name = $(this).attr("data-name");
   
   console.log(id + " | " + name);
   $("#id-group-edit").val(id);
   $("#name-group-edit").val(name);
   
   });
   
   $('.deleteGroup').on('click', function () {
   
   var id = $(this).attr("data-id");
   
   $("#id-group-delete").val(id);
   
   });
   
   $('.showGroup').on('click', function () {
   
   var name = "#" + $(this).attr("data-name");
   console.log($(name).is(":visible"))
      if($(name).is(":visible"))
      {
         $( name  ).slideUp(800);
      }
      else
      {
         $( name  ).slideDown(800);
      }
   
   });
   

</script>
@endpush