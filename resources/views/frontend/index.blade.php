@extends('layouts.main')

@section('content')
<div style="width:100%; height:95vh; color:#000; font-size:24px;">
    <div class="row justify-content-center">
        <div class="mt-5 pt-5" style="color:#000; font-size:32px; width:100%; text-align:center;">
            Wszystko czego potrzebujesz do zorganizowania wydarzenia w jednym miejscu
        </div>
        <div class="mt-3" style="color:#000; font-size:20px; width:100%; text-align:center;">
            Zaplanuj.pl to apliakcja która pomaga w zorganizowaniu wybranych wydarzeń poprzez rozbudowany panel do 
            <br>zarządzania wydarzeniem, gotową listę zadań do wykonania, umożliwa rezerewację potrzebnych usług i wiele więcej!
        </div>
        <div class="mt-5 mb-5" style="color:#000; font-size:20px; width:100%; text-align:center;">
           <a href="{{route('user.events')}}" class="createEvent">Zorganizuj wydarzenie</a>
        </div>
        <div class="mt-5" style="width:100%; height:150px;"></div>
        <div class="mt-2 mb-5" class="statsMainPage">
            <div class="statsBox">
                <div class="statsBoxRight">
                    <div class="statsBoxNubmer">
                        {{$stats['events']}}
                    </div>
                    <div class="statsBoxText">
                        Zorganizowanych wydarzeń
                    </div>
                </div>
            </div>
            <div class="statsBox">
                <div class="statsBoxRight">
                    <div class="statsBoxNubmer">
                        {{$stats['services']}}
                    </div>
                    <div class="statsBoxText">
                        Dostępnych usług
                    </div>
                </div>
            </div>
            <div class="statsBox">
                <div class="statsBoxRight">
                    <div class="statsBoxNubmer">
                        {{$stats['offers']}}
                    </div>
                    <div class="statsBoxText">
                        Ofert do wyboru
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
