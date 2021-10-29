@extends('layouts.event')

@section('content')
<div class="container mt-5">
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
                  <form method="POST" action="{{ route('statusFinance') }}" class="d-inline">
                     @csrf
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                     <button class="btn btn-warning mr-2">R</button>
                  </form>
                  @else
               <li class="list-group-item row task taskChecked">
                  <form method="POST" action="{{ route('statusFinance') }}" class="d-inline">
                     @csrf
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="0" required>
                     <button class="btn btn-warning mr-2">U</button>
                  </form>
                  @endif
                  <div class="d-inline">
                  {{$guest->name}} 
</div>
                  <div class="float-right"> 
                     
                     <a class="btn btn-primary data" data-toggle="modal" data-target="#exampleModal" data-groupId="{{$guestGroup->id}}" data-id="{{$guest->id}}" data-name="{{$guest->name}}" data-surname="{{$guest->surname}}" data-invitation="{{$guest->invitation}}" data-confirmation="{{$guest->confirmation}}" data-accommodation="{{$guest->accommodation}}" data-diet="{{$guest->diet}}" data-type="{{$guest->type}}" data-advance="{{$guest->advance}}" data-transport="{{$guest->transport}}" data-note="{{$guest->note}}">E</a>
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
                              <h5 class="modal-title" id="exampleModalCenterTitle">Nowy gość</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form method="POST" action="{{ route('addGuest') }}">
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
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="invitation" name="invitation">
                                       <label class="custom-control-label" for="invitation">Wysłane zaproszenie</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="confirmation" name="confirmation">
                                       <label class="custom-control-label" for="confirmation">Potwierdzenie przybycia</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="accommodation" name="accommodation">
                                       <label class="custom-control-label" for="accommodation">Nocleg</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="diet" name="diet">
                                       <label class="custom-control-label" for="diet">Specjalna dieta</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="transport" name="transport">
                                       <label class="custom-control-label" for="transport">Transport</label>
                                    </div>
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
                                 <label for="type" class="col-md-12 col-form-label">Wiek gościa</label>
                                 <div class="col-md-12">
                              <select id="type" class="form-select form-control" name="type" aria-label="Default select example">
                                <option value="Dorosły" selected>Dorosły</option>
                                <option value="Dziecko">Dziecko</option>
                              </select>
                                    </div>
                                    </div>

                              <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$guestGroup->id}}" required>

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
                     <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="guest" required>
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
            <h5 class="modal-title edit" id="exampleModalLabel">Gość</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         <form method="POST" action="{{ route('editGuest') }}">
                              @csrf
                              <div class="form-group">
                                 <label for="name-edit" class="col-md-12 col-form-label">Imie</label>
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
                                 <label for="surname-edit" class="col-md-12 col-form-label">Nazwisko</label>
                                 <div class="col-md-12">
                                    <input id="surname-edit" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="invitation-edit" name="invitation">
                                       <label class="custom-control-label" for="invitation-edit">Wysłane zaproszenie</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="confirmation-edit" name="confirmation">
                                       <label class="custom-control-label" for="confirmation-edit">Potwierdzenie przybycia</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="accommodation-edit" name="accommodation">
                                       <label class="custom-control-label" for="accommodation-edit">Nocleg</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="diet-edit" name="diet">
                                       <label class="custom-control-label" for="diet-edit">Specjalna dieta</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-md-12">        
                                    <!-- Default switch -->
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="transport-edit" name="transport">
                                       <label class="custom-control-label" for="transport-edit">Transport</label>
                                    </div>
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
                                 <label for="type-edit" class="col-md-12 col-form-label">Wiek gościa</label>
                                 <div class="col-md-12">
                              <select id="type-edit" class="form-select form-control" name="type" aria-label="Default select example">
                                <option value="Dorosły" selected>Dorosły</option>
                                <option value="Dziecko">Dziecko</option>
                              </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                 <label for="edit-group" class="col-md-12 col-form-label">Grupa</label>
                                 <div class="col-md-12">
                                    <select id="edit-group" class="form-select form-control" name="group" aria-label="Default select example">
                                    @foreach($guests as $group)
                                       <option value="{{$group->id}}">{{$group->name}}</option>
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
            <h5 class="modal-title" id="exampleModalLabel">Usuń</h5>
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
         <button type="submit" class="btn btn-primary">Usuń gościa</button>
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
   var surname = $(this).attr("data-surname");
   var invitation = $(this).attr("data-invitation");
   var confirmation = $(this).attr("data-confirmation");
   var accommodation = $(this).attr("data-accommodation");
   var diet = $(this).attr("data-diet");
   var type = $(this).attr("data-type");
   var transport = $(this).attr("data-transport");
   var note = $(this).attr("data-note");

   var groupId = $(this).attr("data-groupId");

   $("#id-edit").val(id);
   $("#name-edit").val(name);
   $("#surname-edit").val(surname);
   $("#type-edit").val(type); 
   $("#note-edit").val(note);


   if(invitation == 1){
      $( "#invitation-edit" ).attr( "checked", true);
   }

   if(confirmation == 1){
      $( "#confirmation-edit" ).attr( "checked", true);
   }

   if(accommodation == 1){
      $( "#accommodation-edit" ).attr( "checked", true);
   }

   if(diet == 1){
      $( "#diet-edit" ).attr( "checked", true);
   }

   if(transport == 1){
      $( "#transport-edit" ).attr( "checked", true);
   }
   
   
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