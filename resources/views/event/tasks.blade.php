@extends('layouts.event')

@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
      Lista zadań<br>    
      <div class="row col-12">
         @foreach($tasks as $groupTask)
         <div class="list-group col-12">
            <ul>
               <li class="list-group-item nameGroupTask">
                  {{$groupTask->name}}
               </li>
               @foreach($groupTask->tasks as $task)
               <li class="list-group-item task">
                  {{$task->name}} 
                  <div class="float-right">
                    {{$task->end_task}}
                  </div>
                  @endforeach
               <li class="list-group-item">
                  
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask{{$groupTask->id}}">
                     Dodaj zadanie
                     </button>
                     <!-- Modal -->
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
                                    <label for="name" class="col-md-12 col-form-label">Nazwa</label>
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
               </li>
            </ul>
         </div>
         @endforeach

         <hr>
         <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGroup">
  Dodaj grupę
</button>

<!-- Modal -->
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
</div>



@endsection
