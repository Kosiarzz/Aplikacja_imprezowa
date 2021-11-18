<!doctype html>
<html lang="pl_PL">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    </head>
    <body style="font-family: DejaVu Sans;">
        <div style="font-family: DejaVu Sans;">
            @foreach($finances as $finance)
                @foreach($finance->costs as $cost)
                    {{$cost->name}}
                    {{$cost->cost}} zł 
                    {{$cost->advance}} zł 
                    {{$cost->date_payment}} 
                    {{$cost->note}}
                    <hr><br>
                @endforeach
                <hr><hr>
            @endforeach
        </div>
    </body>
</html>