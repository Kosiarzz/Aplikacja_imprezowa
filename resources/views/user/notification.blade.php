@extends('layouts.app')

@section('content')
<div class="container">

            @foreach($notifications as $notification)
                @if($notification->status == 0)
                    <div id="noti" class="bg-info"><a href="{{ $notification->id }}">
                        {{$notification->content}}<br>
                        Status: {{$notification->status}}<br>
                        Shown: {{$notification->shown}}
                    </a></div>
                    @else
                    <div id="noti" style="background-color:white;">
                        {{$notification->content}}<br>
                        Status: {{$notification->status}}<br>
                        Shown: {{$notification->shown}}
                    </div>
                @endif
                <hr>
            @endforeach
</div>
@endsection

@push('notify')
    <script>
        $(document).on("click", "#noti", function (event) {
    
            //event.preventDefault(); //bez przejścia w backendzie

            var idOfNotification = parseInt($(this).children().attr('href'));
            $(this).children().removeAttr('href');
            
            var data = {id: idOfNotification};
            console.log(idOfNotification);
            $.ajax({
                cache: false,
                url: base_url + '/setReadNotification',
                type: "GET",
                dataType: "json",
                data: {id: idOfNotification},
                success: function(response){
                    $(this).removeClass('bg-info');
                    
                }
            });
        });
    </script>
@endpush
