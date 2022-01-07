@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage">
         Lista zadań   
   </div>
   
   <div class="row justify-content-center">

   <div class="row col-12">
      @foreach($tasks as $groupTask)
      <div class="list-group col-12 groupList mt-3 mb-3 p-2">
         <div style="height:50px; width:100%; padding-top:10px; padding-left:7px; font-size:20px;">
            {{$groupTask->name}} ({{ count($groupTask->tasks->where('status', 1)) }}/{{ count($groupTask->tasks) }})
            <div class="float-right"> 
               <a class="dataGroup mr-3" data-toggle="modal" data-target="#exampleModalGroup" data-id="{{$groupTask->id}}" data-name="{{$groupTask->name}}" data-color="{{$groupTask->color}}"><i class="fas fa-pen"></i></a>
               <a class="deleteGroup mr-4" data-toggle="modal" data-target="#exampleModalGroupDelete" data-id="{{$groupTask->id}}"><i class="fas fa-trash-alt"></i></a>
               <a class="showGroup mr-3" data-name="groupModal{{$groupTask->id}}"><i class="fas fa-compress-alt"></i></a>
            </div>
         </div>
         <table id="groupModal{{$groupTask->id}}" class="table table-hover mb-0">
            <thead style="background: #558ACA; color:#fff;">
               <tr>
                  <th scope="col" style="width:110px;">Status</th>
                  <th scope="col" style="text-align:left;">Nazwa zadania</th>
                  <th scope="col">Data wykonania</th>
                  <th scope="col"></th>
               </tr>
            </thead>
            <tbody>
               @foreach($groupTask->tasks as $task)
               <tr>
                  <td>
                     @if($task->status == 0)
                     <form method="POST" action="{{ route('statusTask') }}" class="d-inline">
                        @csrf
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$task->id}}" required>
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                        <button class="taskComplete"><i class="far fa-check-circle iconGuest" style="color:#ddd; cursor: pointer;"></i></button>
                     </form>
                     @else
                     <form method="POST" action="{{ route('statusTask') }}" class="d-inline">
                        @csrf
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$task->id}}" required>
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="0" required>
                        <button class="taskComplete"><i class="far fa-check-circle iconGuest" style="cursor: pointer;"></i></button>
                     </form>
                     @endif
                  </td>
                  <td style="text-align:left; padding:15px 0 0 10px;">
                     {{str_limit($task->name, 80)}}
                  </td>
                  <td>
                     <div class="mr-4 d-inline">
                        {{$task->end_task}}
                     </div>
                  </td>
                  <td>
                     <a class="data" data-toggle="modal" data-target="#exampleModal" data-id="{{$task->id}}" data-groupId="{{$groupTask->id}}" data-name="{{$task->name}}" data-date="{{$task->end_task}}"><i class="fas fa-pen"></i></a>
                     <a class="delete ml-4" data-toggle="modal" data-target="#exampleModalDelete" data-id="{{$task->id}}"><i class="fas fa-trash-alt"></i></a>
                  </td>
               </tr>
               @endforeach
               <tr class="border-top">
                  <td colspan="2" class="table-button"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask{{$groupTask->id}}">Dodaj zadanie</button></td>
               </tr>
            </tbody>
         </table>
         <div class="modal fade" id="addTask{{$groupTask->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalCenterTitle">Nowe zadanie</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <form method="POST" action="{{ route('addTask') }}">
                     @csrf
                     <div class="form-group">
                        <label for="name" class="col-md-12 col-form-label">Nazwa zadania</label>
                        <div class="col-md-12">
                           <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="date" class="col-md-12 col-form-label">Data</label>
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
                        <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$groupTask->id}}" required>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary">Dodaj zadanie</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      @endforeach
      <hr>
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

                     <div class="form-group row">
                        <label for="group-color-edit" class="col-md-12 col-form-label">Kolor grupy</label>
                        <div class="col-md-12">
                           <input id="group-color-edit" type="color" class="form-control @error('group-color-edit') is-invalid @enderror" name="color" value="{{ old('group-color-edit') }}" required>
                           @error('group-color-edit')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                     </div>

                     <input  type="hidden" class="form-control @error('type') is-invalid @enderror" name="type" value="task" required>
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
<!-- PDF task modal -->
<div class="modal" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Pobieranie zadań</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('event.pdfTasks') }}">
               @csrf
               <div class="form-group">
                  <label for="name-pdf" class="col-md-12 col-form-label">Nazwa pliku</label>
                  <div class="col-md-12">
                     <input id="name-pdf" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="Zadania" required autocomplete="name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-primary" id="pdfexport">Pobierz pdf</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Edit task modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Twoje zadanie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('editTask') }}">
               @csrf
               <div class="form-group">
                  <label for="name-edit" class="col-md-12 col-form-label">Nazwa zadania</label>
                  <div class="col-md-12">
                     <input id="name-edit" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="form-group">
                  <label for="date-edit" class="col-md-12 col-form-label">Data</label>
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
                        @foreach($tasks as $groupTask)
                        <option value="{{$groupTask->id}}">{{$groupTask->name}}</option>
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
<!-- Delete task modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Usuwanie zadania</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Czy chcesz usunąć to zadanie?
            <form method="POST" action="{{ route('deleteTask') }}">
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
               <div class="form-group">
                  <label for="color-group-edit" class="col-md-12 col-form-label">Kolor grupy</label>
                  <div class="col-md-12">
                     <input id="color-group-edit" type="color" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color">
                     @error('color')
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
   $("#task").addClass("active");
   
   $('.data').on('click', function () {
   
      var id = $(this).attr("data-id");
      var name = $(this).attr("data-name");
      var date = $(this).attr("data-date");
      var groupId = $(this).attr("data-groupId");
   
      $("#id-edit").val(id);
      $("#name-edit").val(name);
      $("#date-edit").val(date);
   
      $("#edit-group option[value=" + groupId + "]").prop("selected", true);
   });
   
   $('.delete').on('click', function () {
   
   var id = $(this).attr("data-id");
   
   $("#id-delete").val(id);
   });
   
   $('.dataGroup').on('click', function () {
   
   var id = $(this).attr("data-id");
   var name = $(this).attr("data-name");
   var color = $(this).attr("data-color");
   
   console.log(id + " | " + name);
   $("#id-group-edit").val(id);
   $("#name-group-edit").val(name);
   $("#color-group-edit").val(color);
   
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
         $( name  ).slideUp(10);
      }
      else
      {
         $( name  ).slideDown(10);
      }
   
   });
   
   
   $('#pdfexport').on('click', function () {

   });
   
</script>
@endpush