<!doctype html>
<html lang="pl_PL">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

      <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    

    </head>
    <body style="font-family: DejaVu Sans;">
        <div style="font-family: DejaVu Sans;">
            @foreach($guests as $guestGroup)
            <table id="groupModal{{$guestGroup->id}}" class="table table-striped">
               <thead>
                  <tr>
                     <th scope="col">status</th>
                     <th scope="col">Imię i nazwisko</th>
                     <th scope="col">Potwierdzenie</th>
                     <th scope="col">Zaproszenie</th>
                     <th scope="col">Nocleg</th>
                     <th scope="col">Dieta</th>
                     <th scope="col">Transport</th>
                     <th scope="col">Rodzaj</th>
                     <th scope="col">Notatka</th>
                     <th scope="col">Akcje</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($guestGroup->guests as $guest) 

                  <tr>
                     <td>
                        <form method="POST" action="{{ route('statusFinance') }}" class="d-inline">
                           @csrf
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="id" value="{{$guest->id}}" required>
                           <input type="hidden" class="form-control @error('type') is-invalid @enderror" name="status" value="1" required>
                           <button class="btn btn-warning mr-2">R</button>
                        </form>
                     </td>
                     <td>{{$guest->name}} {{$guest->surname}}</td>
                     <td>{{$guest->confirmation}}</td>
                     <td>{{$guest->invitation}}</td>
                     <td>{{$guest->accommodation}}</td>
                     <td>{{$guest->diet}}</td>
                     <td>{{$guest->transport}}</td>
                     <td>{{$guest->type}}</td>
                     <td>{{$guest->note}}</td>
                     <td>
                        <a class="btn btn-primary data" data-toggle="modal" data-target="#exampleModal" data-groupId="{{$guestGroup->id}}" data-id="{{$guest->id}}" data-name="{{$guest->name}}" data-surname="{{$guest->surname}}" data-invitation="{{$guest->invitation}}" data-confirmation="{{$guest->confirmation}}" data-accommodation="{{$guest->accommodation}}" data-diet="{{$guest->diet}}" data-type="{{$guest->type}}" data-advance="{{$guest->advance}}" data-transport="{{$guest->transport}}" data-note="{{$guest->note}}">E</a>
                        <a class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModalDelete" data-id="{{$guest->id}}">X</a>
                     </td>
                  </tr>

                  @endforeach
                  </tbody>
            </table>
            @endforeach
        </div>
    </body>
</html>