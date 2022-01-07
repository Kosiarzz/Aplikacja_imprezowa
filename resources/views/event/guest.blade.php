@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage mb-3">
      Lista gości
   </div>
   <div class="row col-12 mt-3 p-2 mb-5">
      <div class="col-4 stasGuestsBox">
         <div class="guestBox mb-2">
            <div class="guestBoxIcon">
               <i class="fas fa-users"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['adults'] + $guestsDetails['children']}}
                </div>
                <div class="guestBoxText">
                Liczba gości na przyjęciu
                </div>
            </div>
        </div>

        <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['adults']}}
                </div>
                <div class="guestBoxText">
                  Dorosłych
                </div>
            </div>
        </div>

        <div class="guestBox">
            <div class="guestBoxIcon">
               <i class="fas fa-baby"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['children']}}
                </div>
                <div class="guestBoxText">
                Dzieci
                </div>
            </div>
        </div>
         

      </div>
      <div class="col-4 stasGuestsBox">  

         <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="far fa-check-circle"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['confirmation']}}
                </div>
                <div class="guestBoxText">
                Potwierdzenia
                </div>
            </div>
        </div>

         <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="far fa-envelope"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['invitation']}}
                </div>
                <div class="guestBoxText">
                Wysłanych zaproszeń
                </div>
            </div>
        </div>

        <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="far fa-check-circle" style="color:#ddd;"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['nonConfirmation']}}
                </div>
                <div class="guestBoxText">
                Niepotwierdzonych
                </div>
            </div>
        </div>

      </div>
      
      <div class="col-4 stasGuestsBox">  

         <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="fas fa-bed"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['accommodation']}}
                </div>
                <div class="guestBoxText">
                Nocleg
                </div>
            </div>
        </div>

        <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="fas fa-utensils"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['diet']}}
                </div>
                <div class="guestBoxText">
                Specjalna dieta
                </div>
            </div>
        </div>

        <div class="guestBox mb-2">
            <div class="guestBoxIcon">
                <i class="fas fa-bus-alt"></i>
            </div>
            <div class="guestBoxRight">
                <div class="guestBoxNubmer">
                {{$guestsDetails['transport']}}
                </div>
                <div class="guestBoxText">
                Transport
                </div>
            </div>
        </div>

      </div>
      
   </div>

   <div class="row justify-content-center">
      
      <div class="row col-12">
         @foreach($guests as $guestGroup)
         <div class="row col-12 mt-2 groupList p-2 mb-4">
            <div style="height:50px; width:100%; padding-top:10px; font-size:20px;">
               <div class="float-left pl-3">{{$guestGroup->name}} ({{ count($guestGroup->guests->where('confirmation', 1)) }}/{{ count($guestGroup->guests) }})</div>
               <div class="float-right"> 
                  <a class="dataGroup mr-3" data-toggle="modal" data-target="#exampleModalGroup" data-id="{{$guestGroup->id}}" data-name="{{$guestGroup->name}}" data-color="{{$guestGroup->color}}"><i class="fas fa-pen"></i> </a>
                  <a class="deleteGroup mr-2" data-toggle="modal" data-target="#exampleModalGroupDelete" data-id="{{$guestGroup->id}}"><i class="fas fa-trash-alt"></i></a>
                  <a class="showGroup mr-3 ml-1" data-name="groupModal{{$guestGroup->id}}"><i class="fas fa-compress-alt"></i></a>
               </div>
            </div>
            <table id="groupModal{{$guestGroup->id}}" class="table table-hover mb-0">
               <thead style="background: #558ACA; color:#fff;">
                  <tr>
                     <th scope="col">Imię i nazwisko</th>
                     <th scope="col">Potwierdzenie</th>
                     <th scope="col">Zaproszenie</th>
                     <th scope="col">Nocleg</th>
                     <th scope="col">Dieta</th>
                     <th scope="col">Transport</th>
                     <th scope="col">Wiek</th>
                     <th scope="col">Notatka</th>
                     <th scope="col"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($guestGroup->guests as $guest) 
                  <tr>
                     <td>{{$guest->name}} {{$guest->surname}}</td>
                     <td style="text-align: center; ">
                        @if($guest->confirmation)
                           <form method="POST" action="{{ route('statusGuest') }}" class="d-inline">
                              @csrf
                              <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                              <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="0" required>
                              <button class="guestConfirm"><i class="far fa-check-circle iconGuest" style="cursor: pointer;"></i></button>
                           </form>
                        @else
                           <form method="POST" action="{{ route('statusGuest') }}" class="d-inline">
                              @csrf
                              <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                              <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                              <button class="guestConfirm"><i class="far fa-check-circle iconGuest" style="color:#ddd; cursor: pointer;"></i></button> 
                           </form>        
                        @endif
                     </td>
                     <td>
                        @if($guest->invitation)
                           <i class="far fa-envelope iconGuest"></i>
                        @else
                           <i class="far fa-envelope iconGuest" style="color:#ddd;"></i>
                        @endif
                     </td>
                     <td>
                        @if($guest->accommodation)
                        <i class="fas fa-bed iconGuest"></i>
                        @else
                        <i class="fas fa-bed iconGuest" style="color:#ddd;"></i>
                        @endif
                     </td> 
                     <td>
                        @if($guest->diet)
                           <i class="fas fa-utensils iconGuest"></i>
                        @else
                           <i class="fas fa-utensils iconGuest" style="color:#ddd;"></i>
                        @endif
                     </td>
                     <td>
                        @if($guest->transport)
                           <i class="fas fa-bus-alt iconGuest"></i>
                        @else
                           <i class="fas fa-bus-alt iconGuest" style="color:#ddd;"></i>
                        @endif
                     </td>
                     <td>
                        {{$guest->type}}
                     </td>
                     <td style="font-weight:600;">{{str_limit($guest->note,0)}}</td>
                     <td>
                        <a class="data" data-toggle="modal" data-target="#exampleModal" data-groupId="{{$guestGroup->id}}" data-id="{{$guest->id}}" data-name="{{$guest->name}}" data-surname="{{$guest->surname}}" data-invitation="{{$guest->invitation}}" data-confirmation="{{$guest->confirmation}}" data-accommodation="{{$guest->accommodation}}" data-diet="{{$guest->diet}}" data-type="{{$guest->type}}" data-advance="{{$guest->advance}}" data-transport="{{$guest->transport}}" data-note="{{$guest->note}}"><i class="fas fa-pen"></i> </a>
                        <a class="delete ml-4 mr-4" data-toggle="modal" data-target="#exampleModalDelete" data-id="{{$guest->id}}"><i class="fas fa-trash-alt"></i></a>
                     </td>
                  </tr>
                  @endforeach
                  <tr class="border-top">
                     <td class="table-button"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTask{{$guestGroup->id}}">Dodaj gościa</button></td>
                  </tr>
               </tbody>
            </table>
         </div>
         
         
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
                              <input type="checkbox" class="custom-control-input" id="invitation{{$guestGroup->id}}" name="invitation">
                              <label class="custom-control-label" for="invitation{{$guestGroup->id}}">Wysłane zaproszenie</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <!-- Default switch -->
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="confirmation{{$guestGroup->id}}" name="confirmation">
                              <label class="custom-control-label" for="confirmation{{$guestGroup->id}}">Potwierdzenie przybycia</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <!-- Default switch -->
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="accommodation{{$guestGroup->id}}" name="accommodation">
                              <label class="custom-control-label" for="accommodation{{$guestGroup->id}}">Nocleg</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <!-- Default switch -->
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="diet{{$guestGroup->id}}" name="diet">
                              <label class="custom-control-label" for="diet{{$guestGroup->id}}">Specjalna dieta</label>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-12">
                           <!-- Default switch -->
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="transport{{$guestGroup->id}}" name="transport">
                              <label class="custom-control-label" for="transport{{$guestGroup->id}}">Transport</label>
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
         @endforeach
      </div>
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
                  <div class="form-group">
                     <label for="color-group-add" class="col-md-12 col-form-label">Kolor grupy</label>
                     <div class="col-md-12">
                        <input id="color-group-add" type="color" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color">
                        @error('color')
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
<!-- PDF task modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Pobieranie listy gości</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('event.pdfGuests') }}"> 
               @csrf
               <div class="form-group">
                  <label for="name-pdf" class="col-md-12 col-form-label">Nazwa pliku</label>
                  <div class="col-md-12">
                     <input id="name-pdf" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="Goście" required autocomplete="name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-danger">Pobierz pdf</button>
               </div>
            </form>
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
      $( "#invitation-edit" ).prop( "checked", true);
      console.log("invitation: true");
   }
   else
   {
      $( "#invitation-edit" ).prop( "checked", false);
      console.log("invitation: false");
   }
   
   if(confirmation == 1){
      $( "#confirmation-edit" ).prop( "checked", true);
      console.log("confirmation: true");
   }
   else
   {
      $( "#confirmation-edit" ).prop( "checked", false);
      console.log("confirmation: false");
   }
   
   if(accommodation == 1){
      $( "#accommodation-edit" ).prop( "checked", true);
      console.log("accommodation: true");
   }
   else
   {
      $( "#accommodation-edit" ).prop( "checked", false);
      console.log("accommodation: false");
   }
   
   if(diet == 1){
      $( "#diet-edit" ).prop( "checked", true);
      console.log("diet: true");
   }
   else
   {
      $( "#diet-edit" ).prop( "checked", false);
      console.log("diet: false");
   }
   
   if(transport == 1){
      $( "#transport-edit" ).prop( "checked", true);
      console.log("transport: true");
   }
   else
   {
      $( "#transport-edit" ).prop( "checked", false);
      console.log("transport: false");
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
         $(name).slideUp(100);
      }
      else
      {
         $(name).slideDown(100);
      }
   
   });
   
   
</script>
@endpush