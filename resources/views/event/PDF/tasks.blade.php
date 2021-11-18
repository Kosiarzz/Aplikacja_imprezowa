<!doctype html>
<html lang="pl_PL">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    </head>
    <body style="font-family: DejaVu Sans;">
        <div style="font-family: DejaVu Sans;">
            @foreach($tasks as $groupTask)
                @foreach($groupTask->tasks as $task)
                    {{$task->name}}<br>
                @endforeach
            @endforeach
        </div>
    </body>
</html>