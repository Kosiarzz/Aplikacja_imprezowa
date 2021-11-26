<!doctype html>
<html lang="pl_PL">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   </head>
   <body style="font-family: DejaVu Sans;">
      <div style="font-family: DejaVu Sans;">
            
         <div style="width:100%; text-align:center; font-size:34px; color:3a4754;">Lista gości</div>
         <div style="width:100%; text-align:center; font-size:26px; color:3a4754;">{{$guests['event']->name}}</div>
         <div style="width:100%; text-align:center; font-size:20px; color:3a4754;">{{$guests['event']->date_event}}</div>

            @foreach($guests['groupEvent'] as $guestGroup)
            <div style="border-bottom:1px solid black; margin-bottom:40px; padding:5px;">
               <div style="height:40px; width:100%; maring-left:10px; font-size:20px;">
                  {{$guestGroup->name}} ({{ count($guestGroup->guests) }})
               </div>
               <table class="table mb-0" style="width:100%;">
                  <thead style="background: #8399af; color:#fff;">
                  <tr style="font-size:10px;">
                     <th scope="col" style="width:180px; font-size:12px;">Imię i nazwisko</th>
                     <th scope="col" style="font-size:10px;">Potwierdzenie</th>
                     <th scope="col">Zaproszenie</th>
                     <th scope="col">Nocleg</th>
                     <th scope="col">Dieta</th>
                     <th scope="col">Transport</th>
                     <th scope="col">Wiek</th>
                     <th scope="col">Notatka</th>
                  </tr>
               </thead>
               <tbody>
               @php ($i = 1)
                  @foreach($guestGroup->guests as $guest) 
                  @if($i%2 == 0)
                           <tr style="background-color:#ddd;">
                        @else
                           <tr>
                        @endif
                     <td style="text-align:center;">{{$guest->name}} {{$guest->surname}}</td>
                     <td>
                        @if($guest->confirmation)
                           <input type="checkbox" style="font-size:25px; margin-left:35px; border:0px;" checked>
                        @else
                           <input type="checkbox" style="font-size:25px; margin-left:35px; border:0px;">
                        @endif
                     </td>
                     <td>
                        @if($guest->invitation)
                           <input type="checkbox" style="font-size:25px; margin-left:30px; border:0px;" checked>
                        @else
                           <input type="checkbox" style="font-size:25px; margin-left:30px; border:0px;">
                        @endif
                     </td>
                     <td>
                        @if($guest->accommodation)
                           <input type="checkbox" style="font-size:25px; margin-left:15px; border:0px;" checked>
                        @else
                           <input type="checkbox" style="font-size:25px; margin-left:15px; border:0px;">
                        @endif
                     </td>
                     <td>
                        @if($guest->diet)
                           <input type="checkbox" style="font-size:25px; margin-left:12px; border:0px;" checked>
                        @else
                           <input type="checkbox" style="font-size:25px; margin-left:12px; border:0px;">
                        @endif
                     </td>
                     <td>
                        @if($guest->transport)
                           <input type="checkbox" style="font-size:25px; margin-left:25px; border:0px;" checked>
                        @else
                           <input type="checkbox" style="font-size:25px; margin-left:25px; border:0px;">
                        @endif
                     </td>
                     <td style="font-size:11px; text-align:center;">{{$guest->type}}</td>
                     <td style="font-size:11px;">{{$guest->note}}</td>
                  </tr>
                  @php($i++)
                  @endforeach
                  </tbody>
               </table>
            </div>
            @endforeach
        </div>
    </body>
</html>