<!doctype html>
<html lang="pl_PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body style="font-family: DejaVu Sans;">
        <div style="font-family: DejaVu Sans;">

            <div style="width:100%; text-align:center; font-size:34px; color:3a4754;">Budżet</div>
            <div style="width:100%; text-align:center; font-size:26px; color:3a4754;">{{$finances['event']->name}}</div>
            <div style="width:100%; text-align:center; font-size:20px; color:3a4754;">{{$finances['event']->date_event}}</div>

            @foreach($finances['groupEvent'] as $finance)
                <div style="border-bottom:1px solid black; margin-bottom:40px; padding:5px;">
                    <div style="height:40px; width:100%; maring-left:10px; font-size:20px;">
                    {{$finance->name}} ({{ count($finance->costs) }})
                    </div>
                    <table class="table mb-0" style="width:100%;">
                    <thead style="background: #8399af; color:#fff;">
                        <tr>
                            <th scope="col" style="width:110px;"></th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Koszt</th>
                            <th scope="col">Zaliczka</th>
                            <th scope="col">Data płatności</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach($finance->costs as $cost)
                            @if($i%2 == 0)
                            <tr style="background-color:#ddd;">
                                @else
                            <tr>
                            @endif
                                <td style="width:30px;">
                                    @if($cost->status)
                                    <input type="checkbox" style="font-size:30px; margin-left:2px;" checked>
                                    @else
                                    <input type="checkbox" style="font-size:30px; margin-left:2px;">
                                    @endif
                                </td>
                                <td style="text-align:center;">{{$cost->name}}</td>
                                <td style="text-align:center;">
                                    @if(($cost->cost * $cost->quantity) == 0)
                                        
                                    @else
                                        {{$cost->cost * $cost->quantity}} zł
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @if($cost->advance == 0)
                                    
                                    @else
                                        {{$cost->advance}} zł
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @if($cost->date_payment == 0)
                                    
                                    @else
                                        {{$cost->date_payment}} zł
                                    @endif
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