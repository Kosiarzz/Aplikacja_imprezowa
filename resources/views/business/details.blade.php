@extends('layouts.business')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        owasp top 10 web security risk
        mitre attack
      
        Szczegóły widoku właściciela firmy
        {{$business->title}} ({{$business->city->name}})<br>
        {{$business->range}}<br>
        {{$business->description}}<br>
        od {{$business->priceFrom}}
        do {{$business->priceTo}} 
        {{$business->unit}} <br><br>Adres: 
        {{$business->address->street}} -  {{$business->address->post_code}}  

        <br><br>
        {{$business->address->phone}}<br>
        {{$business->address->business_name}}<br>  
        {{$business->address->details_address}}<br>
        <br>Odwiedź nas: <br>
        {{$business->social->facebook}}
        {{$business->social->instagram}}
        {{$business->social->www}}
        {{$business->social->youtube}}
        {{$business->social->movie_youtube}}
        <br><br>
        Ilość polubień: {{$business->users->count()}}
        <br><br>

        Kategorie <br>
      
        IMPREZY<br>
        @foreach($business->categories as $category)
            @foreach($category->category as $categ)
                @if($categ->type == 'party')
                    {{$categ->name}},
                @endif
            @endforeach
        @endforeach

        <br>LOKAL<br>
        @foreach($business->categories as $category)
            @foreach($category->category as $categ)
                @if($categ->type == 'lokal')
                    {{$categ->name}}
                @endif
            @endforeach
        @endforeach

        <br>Dodatkowe informacje<br>
        @foreach($business->categories as $category)
            @foreach($category->category as $categ)
                @if($categ->type == 'dinfo')
                    {{$categ->name}},
                @endif
            @endforeach
        @endforeach

        <br>Atrakcje<br>
        @foreach($business->categories as $category)
            @foreach($category->category as $categ)
                @if($categ->type == 'atrakcje')
                    {{$categ->name}},
                @endif
            @endforeach
        @endforeach

        <br>>Własne kategorie<br>
        @foreach($business->categories as $category)
            @foreach($category->category as $categ)
                @if($categ->type == 'user')
                    {{$categ->name}},
                @endif
            @endforeach
        @endforeach
        <br>
        
        Zdjęcia firmy
        <div class="mb-2" style="width:100%;">
            @foreach($business->photos as $photo)
                <img src="{{asset('storage/'.$photo->path)}}" class="mr-3 mb-3" width="219" height="121" alt="NIE MA">
            @endforeach
        </div>

        <br>Polubili to:<br>
        <div style="width:100%">
            @foreach($business->users as $user)
                <a href="{{route('findUserProfile', ['id' => $user->id])}}" class="mr-3 mb-3" style="width:200px; height:80px;">
                    <img src="{{$user->photos->path ?? $defaultPhoto}}" title="{{$user->name}} {{$user->surname}} | {{$user->email}}" width="119" height="61" alt="NIE MA">
                </a>
            @endforeach
        </div>
        
        <br><br>SALE<br>
        @foreach($business->rooms as $room)
            <a href="{{route('roomDetails', ['id' => $room->id])}}" class="w-100 mb-4">
                <div class="row border mb-4">
                    
                    <img src="{{asset('storage/'.$room->photos[0]->path)}}" width="250" height="121" class="mr-3" alt="SALA"><br>
                    Tytuł: {{$room->title}}<br>
                    Opis: {{ str_limit($room->description, 50) }}<br>
                    Ludzi od: {{$room->people_from}}<br>
                    Ludzi do: {{$room->people_to}}<br>
                        
                </div>
            </a>
        @endforeach

        <br><br>KOMENTARZE<br>
        @foreach($business->comments as $comment)
            <a href="{{route('findUserProfile', ['id' => $comment->user->id])}}" class="w-100 mb-4">
                <div class="row border mb-4">
                    <img src="{{$comment->photos->first()->path ?? $defaultPhoto}}" width="250" height="121" class="mr-3" alt="SALA"><br>
                    {{$comment->user->name}} {{$comment->user->surname}}<br>
                    {{str_limit($comment->content,100)}}<br>
                    rating: {{ $comment->rating }}<br>
                </div>
            </a>
        @endforeach

        <br><br>Q&A<br>
        @foreach($business->questionsAndAnswers as $qAndA)
            <div class="row border w-100 mb-4">
                pytanie: {{$qAndA->question}}<br>
                odpowiedź: {{$qAndA->answer}}<br>
            </div>
        @endforeach

        @auth()
            <form method="POST" action="{{ route('addComment',['commentable_id'=>$business->id, 'App\Models\Business']) }}" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Komentarz</label>
                        <div class="col-lg-10">
                            <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">Dodaj komentarz</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Ocena</label>
                        <div class="col-lg-10">
                            <select name="rating" class="form-control" id="select">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Wyślij</button>
                        </div>
                    </div>
                </fieldset>
                {{ csrf_field() }}
            </form>
        @else
            <a href="{{ route('login') }}">Zaloguj się aby dodać komentarz</a>
        @endauth
                
    <!--
        #tytuł
        #adres firmy (miasto,ulica i numer)
        #zakres działania firmy
        dodatkowe info do adresu
        telefon
        #opis
        dodanie do ulubionych
        polubiane
        oceny(gwiazdki)
        #zakres cenowy
        #jednostka(za dzień/godzine/osobę etc)
    kategorie
        komentarze
    mapa
        #dane firmy
        #socials
        #galeria zdjęć
        #filmik promujący
        Q&A
        
    -->
    </div>
</div>
@endsection
