<!doctype html>
<html lang="pl_PL">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   </head>
   <body style="font-family: DejaVu Sans;">
      <div style="font-family: DejaVu Sans;">

         <div style="width:100%; text-align:center; font-size:34px; color:3a4754;">Lista zadań</div>
         <div style="width:100%; text-align:center; font-size:26px; color:3a4754;">{{$tasks['event']->name}}</div>
         <div style="width:100%; text-align:center; font-size:20px; color:3a4754;">{{$tasks['event']->date_event}}</div>

         @foreach($tasks['groupEvent'] as $groupTask)
            <div style="border-bottom:1px solid black; margin-bottom:40px; padding:5px;">
               <div style="height:40px; width:100%; maring-left:10px; font-size:20px;">
                  {{$groupTask->name}} ({{ count($groupTask->tasks) }})
               </div>
               <table class="table mb-0" style="width:100%;">
                  <thead style="background: #8399af; color:#fff;">
                     <tr>
                        <th scope="col" style="width:110px;"></th>
                        <th scope="col" style="text-align:left; width:400px; padding-left:10px;">Nazwa zadania</th>
                        <th scope="col">Data wykonania</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php ($i = 1)
                     @foreach($groupTask->tasks as $task)
                        @if($i%2 == 0)
                           <tr style="background-color:#ddd;">
                        @else
                           <tr>
                        @endif
                              <td style="width:50px;">
                                 @if($task->status)
                                    <input type="checkbox" style="font-size:30px; margin-left:10px; border:0px;" checked>
                                 @else
                                    <input type="checkbox" style="font-size:30px; margin-left:10px; border:0px;">
                                 @endif
                              </td>
                              <td style="text-align:left; padding:0 0 0 10px;">
                                 {{str_limit($task->name, 80)}}
                              </td>
                              <td>
                                 <div style="text-align:center;">
                                    {{$task->end_task}}
                                 </div>
                              </td>
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