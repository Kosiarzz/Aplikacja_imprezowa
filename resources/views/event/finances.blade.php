@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage mb-4 ml-0 p-0">
      Zarządzanie finansami
   </div>
   <div class="row justify-content-center">
      <div class="row col-12 mb-4 p-0">
         <div class="indexBoxFinances">
            <a id="budget-box-edit" style="position: absolute; left:29%; top:8%;" data-toggle="modal" data-target="#budgetModal" data-budget="{{ $budgetDetails['budget'] }}">
               <i class="fas fa-pen"></i> 
            </a>
            <div class="indexBoxFinancesName">
               Budżet
            </div>
            <div class="indexBoxFinancesNumber">
               <span id="budget" class="money">{{ $budgetDetails['budget'] }}</span> <span class="pln">zł</span>
            </div>
         </div>
         <div class="indexBoxFinances ml-2 mr-2">
            <div class="indexBoxFinancesName">
               Zaplanowane wydatki
            </div>
            <div class="indexBoxFinancesNumber">
               <span id="sumExpenses" class="money">{{ $budgetDetails['sumExpenses'] }}</span> <span class="pln">zł</span>
            </div>
         </div>
         <div class="indexBoxFinances">
            <div class="indexBoxFinancesName">
               Pozostało do wydania
            </div>
            <div class="indexBoxFinancesNumber">
               <span id="sumExpensesBudget" class="money">{{$budgetDetails['budget'] - $budgetDetails['sumExpenses'] }}</span> <span class="pln">zł</span>
            </div>
         </div>
      </div>
      <div class="row col-12">
         @foreach($finances as $finance)
         <div class="row col-12 mt-4 groupList p-2">
            <div style="height:50px; width:100%; padding-top:7px; font-size:20px;">
               <span style="padding-left:10px;">{{$finance->name}} ({{ count($finance->costs->where('status', 1)) }} / {{ count($finance->costs) }})</span>
               <div style="float:right;">
                  <a class="dataGroup mr-3" data-toggle="modal" data-target="#exampleModalGroup" data-id="{{$finance->id}}" data-name="{{$finance->name}}" data-color="{{$finance->color}}">
                     <i class="fas fa-pen"></i> 
                  </a>
                  <a class="deleteGroup mr-3" data-toggle="modal" data-target="#exampleModalGroupDelete" data-id="{{$finance->id}}">
                     <i class="fas fa-trash-alt"></i>
                  </a>
                  <a class="showGroup mr-2" style="padding: 6px 0;" data-name="groupModal{{$finance->id}}">
                     <i class="fas fa-compress-alt"></i>
                  </a>
               </div>
            </div>
            <table id="groupModal{{$finance->id}}" class="table table-hover mb-0">
               <thead style="background: #8399af; color:#fff;">
                  <tr>
                     <th scope="col">Status</th>
                     <th scope="col">Nazwa</th>
                     <th scope="col">Koszt</th>
                     <th scope="col">Zaliczka</th>
                     <th scope="col">Data płatności</th>
                     <th scope="col">Notatka</th>
                     <th scope="col"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($finance->costs as $cost)
                  <tr>
                     <td style="width:30px;">
                        @if($cost->status == 1)
                        <form method="POST" action="{{ route('statusFinance') }}" class="d-inline">
                           @csrf
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$cost->id}}" required>
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="0" required>
                           <button class="taskComplete">
                           <i class="far fa-check-circle iconGuest" style="cursor: pointer;"></i>
                           </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('statusFinance') }}" class="d-inline">
                           @csrf
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$cost->id}}" required>
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                           <button class="taskComplete">
                           <i class="far fa-check-circle iconGuest" style="color:#ddd; cursor: pointer;"></i>
                           </button>
                        </form>
                        @endif
                     </td>
                     <td>{{$cost->name}}</td>
                     <td class="money">{{$cost->cost * $cost->quantity}} zł</td>
                     <td class="money">{{$cost->advance}} zł</td>
                     <td>{{$cost->date_payment}}</td>
                     <td>{{str_limit($cost->note, 15)}}</td>
                     <td>
                        <a class="data" data-toggle="modal" data-target="#exampleModal" data-groupId="{{$finance->id}}" data-groupName="{{$finance->name}}" data-id="{{$cost->id}}" data-name="{{$cost->name}}" data-date="{{$cost->date_payment}}" data-note="{{$cost->note}}" data-cost="{{$cost->cost}}" data-count="{{$cost->quantity}}" data-advance="{{$cost->advance}}">
                        <i class="fas fa-pen"></i> 
                        </a>
                        <a class="delete ml-4" data-toggle="modal" data-target="#exampleModalDelete" data-id="{{$cost->id}}">
                        <i class="fas fa-trash-alt"></i>
                        </a>
                     </td>
                  </tr>
                  @endforeach
                  <tr class="border-top">
                     <td colspan="2" style="text-align:left;"><button type="button" class="btn btn-primary mt-1 mb-1" data-toggle="modal" data-target="#addTask{{$finance->id}}">Dodaj koszty</button></td>
                  </tr>
               </tbody>
            </table>
         </div>
      <div class="modal fade" id="addTask{{$finance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                     <label for="name" class="col-md-12 col-form-label">Nazwa kosztów</label>
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
                     <label for="cost" class="col-md-12 col-form-label">Koszt</label>
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
                     <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="group" value="{{$finance->id}}" required>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                     <button type="submit" class="btn btn-primary">Dodaj koszty</button>
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
                  <div class="form-group row">
                     <label for="group-color" class="col-md-12 col-form-label">Kolor grupy</label>
                     <div class="col-md-12">
                        <input id="group-color" type="color" class="form-control @error('group-color') is-invalid @enderror" name="color" value="{{ old('group-color') }}" required>
                        @error('group-color')
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
   <div class="row col-12 mt-4 groupList">
      <div class="col-12 mt-2">Pobierz plik z zaplanowanymi finansami</div>
      <a class="btn btn-danger ml-2 mt-2 mb-2" data-toggle="modal" data-target="#pdfModal">Pobierz pdf</a>
   </div>
   <div class="row col-12 mt-4">
      <div class="indexBoxFinances">
         <div class="indexBoxFinancesName">
            Opłacone zaliczki
         </div>
         <div class="indexBoxFinancesNumber money">
            {{ $budgetDetails['advancePayments'] }} <span class="pln">zł</span>
         </div>
      </div>
      <div class="indexBoxFinances">
         <div class="indexBoxFinancesName">
            Pozostało do zapłaty
         </div>
         <div class="indexBoxFinancesNumber money">
            {{ $budgetDetails['sumExpenses'] - $budgetDetails['advancePayments'] }} <span class="pln">zł</span>
         </div>
      </div>
   </div>
</div>
<!-- PDF task modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Pobieranie budżetu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('event.pdfFinances') }}">
               @csrf
               <div class="form-group">
                  <label for="name-pdf" class="col-md-12 col-form-label">Nazwa pliku</label>
                  <div class="col-md-12">
                     <input id="name-pdf" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="Finanse" required autocomplete="name">
                     @error('name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-primary">Pobierz pdf</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- edit budget modal -->
<div class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title edit" id="exampleModalLabel">Zmiana budżetu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="{{ route('editBudgetFinances') }}">
               @csrf
               <div class="form-group">
                  <label for="budget-edit" class="col-md-12 col-form-label">Budżet</label>
                  <div class="col-md-12">
                     <input id="budget-edit" type="number" min=0 class="form-control @error('budget') is-invalid @enderror" name="budget">
                     @error('budget')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                  <button type="submit" class="btn btn-primary">Zmień budżet</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Edit cost modal -->
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
            <form method="POST" action="{{ route('editFinance') }}">
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
                        @foreach($finances as $finance)
                        <option value="{{$finance->id}}">{{$finance->name}}</option>
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
<!-- Delete cost modal -->
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
            Czy chcesz usunąć to zadanie?
            <form method="POST" action="{{ route('deleteFinance') }}">
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
                     <input id="name-group-edit" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                     @error('name')
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
   $("#finance").addClass("active");
   
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
      var color = $(this).attr("data-color");
      
      console.log(id + " | " + name);
      $("#id-group-edit").val(id);
      $("#name-group-edit").val(name);
      $("#group-color-edit").val(color);
      
   });
   
   $('.deleteGroup').on('click', function () {
   
      var id = $(this).attr("data-id");
      
      $("#id-group-delete").val(id);
      
   });
   
   $('.showGroup').on('click', function () {
   
      var name = "#" + $(this).attr("data-name");

      if($(name).is(":visible"))
      {
         $( name  ).slideUp(100);
      }
      else
      {
         $( name  ).slideDown(100);
      }
   
   });

   $('#budget-box-edit').on('click', function () {
   
      var budget = $(this).attr("data-budget");
      console.log(budget);
      $("#budget-edit").val(budget);
   });

   var money = document.getElementsByClassName("money");
   
   for(var i = 0; i < money.length; i++) {
   
      result = numberWithSpaces(money[i].innerText);
      document.getElementsByClassName("money")[i].innerText = result;
   }

   function numberWithSpaces(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
   }

</script>
@endpush