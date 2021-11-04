@extends('layouts.app')

@section('content')
<div class="container mt-5">


    <div class="row justify-content-center">
        <section class="col-12">
                <div class="d-flex justify-content-between align-items-start titlePrice">
                    <h1 id="notice-header" itemprop="name">
                    {{$business->title}}						
                    </h1>
                    <div id="priceRight">
                            190 zł / osoba
                    </div>
                </div>
                <div id="addInfo" class="d-flex mt-2 mb-2">
                    <span id="city-up">Województwo, {{$business->city->name}}</span>
                </div>

                
    @can('isUser')
        @if($business->isLiked())
            <a href="{{ route('unlike', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}">Usuń z ulubionych</a>
        @else
            <a href="{{ route('like', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}">Dodaj do ulubionych</a> 
        @endif
        
    @elseif(!'isBusiness')
        <a href="{{ route('login') }}">Zaloguj się aby dodać do ulubionych</a>
    @endcan
                                
                <div class="mt-3 hidden-md-down d-flex flex-wrap">
                    <div class="phones">
                       Tel: {{$business->contactable[0]->phone}} Ilość polubień: {{$business->users->count()}}
                    </div>
                </div>
                <div class="line-overflow mt-3">
                    <h2>
                        O nas
                    </h2>
                </div>						
                <p class="description" itemprop="description">{{$business->description}}</p>					
        </section>
    </div>
        {{$business->photos->first()->path}}
    <div class="row justify-content-center">
        <h2>Galeria zdjęć</h2>
        <div class="mb-2" style="width:100%;">
            @foreach($business->photos as $photo)
                <img src="{{asset('storage/'.$photo->path)}}" class="mr-3 mb-3" width="219" height="121" alt="NIE MA">
            @endforeach
        </div>

        <div id="services" class="row mt-4">
            <h2>
                Dostępne obiekty
            </h2>
        </div>	
        
        @foreach($business->services as $service)
            <a href="{{route('serviceDetails', ['id' => $service->id])}}" class="w-100 mb-4">
                <div class="row border mb-4">   
                        @foreach($service->photos as $photo)
                            <img src="{{asset('storage/'.$photo->path)}}" width="250" height="141" class="mr-3" alt="SALA"><br>
                            @break
                        @endforeach
                    Tytuł: {{$service->title}}<br>
                    Opis: {{ str_limit($service->description, 50) }}<br>
                    Osób od: {{$service->people_from}}<br>
                    Osób do: {{$service->people_to}}<br>      
                    Metraż: {{$service->size}} m^2<br> 
                </div>
            </a>
        @endforeach
        <div class="row mt-5">
            <h2>
                Komentarze <span class="h2">({{count($business->comments)}})</span>
            </h2>
        </div>	

        @foreach($business->comments as $comment)
 
            <a href="{{route('findUserProfile', ['id' => $comment->user->id])}}" class="w-100 mb-4">
                <div class="row border mb-4">
                    <img src="" width="250" height="121" class="mr-3" alt="SALA"><br>
                    {{$comment->user->name}} {{$comment->user->surname}}<br>
                    {{str_limit($comment->content,100)}}<br>
                    rating: {{ $comment->rating }}<br>
                </div>
            </a>
        @endforeach
        <div class="row w-100 justify-content-center">
            @can('isUser')
                <form method="POST" action="{{ route('addComment',['commentable_id'=>$business->id, 'App\Models\Business']) }}" class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label">Komentarz/opinia</label>
                                <div class="col-lg-10">
                                    <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="selectRating" class="col-lg-2 control-label">Ocena</label>
                                <div class="col-lg-10">
                                    <select name="rating" class="form-control" id="selectRating">
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
                                    <button type="submit" class="btn btn-primary">Dodaj komentarz</button>
                                </div>
                            </div>
                        </fieldset>
                    {{ csrf_field() }}
                </form>
            @elseif(!'isBusiness')
                <a href="{{ route('login') }}">Zaloguj się aby dodać komentarz</a>
            @endcan
        </div>

  
        <section id="gbook">
            <div class="line-overflow">
                <h2>
                    Częste pytania i odpowiedzi
                </h2>
            </div>
        </section>
 
        @foreach($business->questionsAndAnswers as $qAndA)
            <div class="row border w-100 mb-4">
                pytanie: {{$qAndA->question}}<br>
                odpowiedź: {{$qAndA->answer}}<br>
            </div>
        @endforeach

        
                
    <!--

    mapa

    -->
        <h2>Filmik promujący</h2>
        <iframe width="1080" height="520" src="https://www.youtube.com/embed/Sug433bP-mw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        
        <div class="row w-100 justify-content-center mt-5">
            <div class="line-overflow clearfix">
                <h2>Kontakt</h2>
            </div>
            <div class="row w-100 justify-content-center">
                <address class="business-card">
                        <div class="item">
                            Nazwa firmy: xxxx								
                        </div>
                        <div class="item"> 
                            
                            Imię i nazwisko: {{$business->contactable[0]->name}} {{$business->contactable[0]->surname}}<br>
                            Telefon:  {{$business->contactable[0]->phone}}
                        </div>
                        <div class="item">
                            Adres: {{$business->address->street}} | {{$business->address->post_code}} <br>
                            {{$business->city->name}}, Województwo
                        </div>
                </address>
            </div>
        </div>
            <div id="contactMoreInfo mt-4">
                <h2>Odwiedź nas:</h2>
                <a href="{{$business->social->www}}">Strona WWW</a>
                <a href="{{$business->social->facebook}}">Facebook</a>
                <a href="{{$business->social->instagram}}">Instagram</a>
                <a href="{{$business->social->youtube}}">YouTube</a>
            </div>
    </div>
@endsection
