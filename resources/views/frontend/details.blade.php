@extends('layouts.app')

@section('content')
<div class="container">
<div class="row col-12 groupList mb-3 pb-2">
        <div class="row col-12 justify-content-center">
        <section class="col-12">
            <div class="p-3 titleBusiness" style="font-size:30px; text-align:center;">
                {{$business->title}}						
            </div>
            <div style="text-align:center; color:gold;">
                @for($i=1; $i<=5; $i++)
                    @if($business->rating >= $i)
                        <i class="fas fa-star" style="color:gold;"></i>
                    @else
                        <i class="fas fa-star" style="color:gray;"></i>
                    @endif
                @endfor
                <span style="color:#000;">({{count($business->comments)}})</span>
            </div>
            <div class="row col-12 mt-3" style="justify-content:center; margin-left:1px;">
            @can('isUser')
                @if($business->isLiked())
                    <a href="{{ route('unlike', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}" class="btn likeButton">Usuń z ulubionych</a>
                @else
                    <a href="{{ route('like', ['likeable_id' => $business->id, 'type' => 'App\Models\Business']) }}" class="btn likeButton">Dodaj do ulubionych</a> 
                @endif
            
            @elseif(!'isBusiness')
                <a href="{{ route('login') }}">Zaloguj się aby dodać do ulubionych</a>
            @endcan
            </div>
            <hr>    
            <div class="description mt-2 p-2" style="color:#444956; font-size:15px; text-align:left; white-space: pre-line;">{{$business->description}}</div>
        </section>
        <div class="row col-12 mt-3">
            <div class="col-6">
                <div class="">Obsługiwane wydarzenia</div>
                <ul>  
                    @foreach($partyCategory as $pCategory)
                        @foreach($pCategory->groupCategory as $gCategory)
                            <li style="color:#444956; font-size:15px;">{{$gCategory->category[0]->name}}</li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="col-6">
                <div class="">Dodatkowe informacje</div>
                <ul>
                @foreach($additionalCategory as $aCategory)
                    @foreach($aCategory->groupCategory as $gCategory)
                        <li style="color:#444956; font-size:15px;"> {{$gCategory->category[0]->name}}</li>
                    @endforeach
                @endforeach
                @foreach($userCategory as $uCategory)
                    @foreach($uCategory->groupCategory as $gCategory)
                        <li style="color:#444956; font-size:15px;">{{$gCategory->category[0]->name}}</li>
                    @endforeach
                @endforeach
                </ul>
            </div>
        </div>
    </div>
   </div>
  

    <div class="row col-12 groupList p-0 mb-3 justify-content-center">

      <div id="services" class="row mt-4">
         <h2>Oferty</h2>
      </div>
      <div class="row col-12 pl-4 ml-1 mt-2">
        @foreach($business->services as $service)
            <a href="{{route('serviceDetails', ['id' => $service->id])}}" class="mb-4 mr-3 py-2 pl-1 pr-1 groupList" style="width:250px; color:#444956; text-decoration:none; text-align:center;">
                @foreach($service->photos as $photo)
                    <img src="{{asset('storage/'.$photo->path)}}" width="240" height="141" alt="zdjęcie"><br>
                    @break
                @endforeach
                @if($service->photos->isEmpty())
                    <img src="{{asset('storage/default/photo.jpg')}}" width="240" height="141" alt="zdjęcie"><br>
                @endif
                <div class="mt-2 mb-1 service-title" style="text-align:center; font-size:20px; color:#444956; height:30px; line-height:30px;">{{$service->title}}</div>
                <div class="py-1">
                    @if($service->people_from == $service->people_to)
                        <i class="fas fa-users"></i>    {{$service->people_from}}
                    @else
                        <i class="fas fa-users"></i> {{$service->people_from}} - {{$service->people_to}}
                    @endif
                    
                    @if(!is_null($service->size))
                        <i class="fas fa-house-user ml-3"></i> {{$service->size}} m<sup>2</sup>
                    @endif
                </div>
                @if($service->price_from == $service->price_to)
                    <div class="" style="font-size:16px;"><span class="money">{{$service->price_from}}</span> zł / {{$service->unit}}</div>
                @else
                    <div class="" style="font-size:15px;">od <span class="money">{{$service->price_from}}</span> zł do <span class="money">{{$service->price_to}}</span> zł / {{$service->unit}}</div>
                @endif
            </a>
        @endforeach
      </div>

      <div class="row col-12 justify-content-center mt-5 border-bottom border-top pt-3">
         <div class="line-overflow clearfix">
            <h2>Kontakt</h2>
         </div>
         <div class="row w-100 justify-content-center border-bottom">
            <address class="col-12">
                    <div class="row p-0 mb-1">
                        <div class="col-6" style="text-align:right;">Nazwa firmy:</div> <div class="col-6">{{$business->name}}</div>		
                    </div>		
                    <div class="row mb-1">		
                        <div class="col-6" style="text-align:right;">Imię i nazwisko:</div> <div class="col-6">{{$business->contactable[0]->name}} {{$business->contactable[0]->surname}}</div>
                    </div>	
                    <div class="row mb-1">		
                        <div class="col-6" style="text-align:right;">Telefon:</div> <div class="col-6"><span class="money">{{$business->contactable[0]->phone}}</span></div>
                    </div>
                    <div class="row mb-1">		
                        <div class="col-6" style="text-align:right;">Email:</div> <div class="col-6">{{$business->owner->email}}</div>
                    </div>
                    <div class="row mb-3">		
                        <div class="col-6" style="text-align:right;">Adres:</div> <div class="col-6">{{$business->address->street}}, {{$business->address->post_code}}, {{$business->city->name}}</div>
                    </div>
                <div class="" style="text-align:center;">
                    @if(!is_null($business->social->www))
                        <a href="{{$business->social->www}}"><i class="fas fa-globe mr-3" style="font-size:26px;"></i></a>
                    @endif
                    @if(!is_null($business->social->facebook))
                        <a href="{{$business->social->facebook}}"><i class="fab fa-facebook-f mr-3" style="font-size:26px; color:#0d88ef;"></i></a>
                    @endif
                    @if(!is_null($business->social->instagram))
                        <a href="{{$business->social->instagram}}"><i class="fab fa-instagram mr-3" style="font-size:29px; color:#b328a1;"></i></a>
                    @endif
                    @if(!is_null($business->social->youtube))
                        <a href="{{$business->social->youtube}}"><i class="fab fa-youtube mr-3" style="font-size:29px; color:#ff0000;"></i></a>
                    @endif
                </div>
            </address>
            </div>
            <div class="p-0 m-0 pb-3 col-12 mt-3">
                <div class="line-overflow clearfix" style="text-align:center;">
                    <h3>Godziny otwarcia</h3>
                </div>

                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Poniedziałek:</div> <div class="col-6">{{$business->openingHours->monday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Wtorek:</div> <div class="col-6">{{$business->openingHours->tuesday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Środa:</div> <div class="col-6">{{$business->openingHours->wednesday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Czwartek:</div> <div class="col-6">{{$business->openingHours->thursday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Piątek:</div> <div class="col-6">{{$business->openingHours->friday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Sobota:</div> <div class="col-6">{{$business->openingHours->saturday}}</div>		
                </div>	
                <div class="row p-0 mb-1">
                    <div class="col-6" style="text-align:right;">Niedziela:</div> <div class="col-6">{{$business->openingHours->sunday}}</div>		
                </div>	
                 
            </div>
         
      </div>
</div>
@if(!$business->photos->isEmpty())
<div class="row col-12 groupList mb-3">
   <div class="row justify-content-center mt-3">
      <div class="mb-1" style="font-size:32px;">Galeria zdjęć</div>
      <div id="carouselExampleControls" class="carousel slide pl-1 border-bottom pb-4" data-ride="carousel">
            <div class="carousel-inner">
                @php($i = 1)
                @foreach($business->photos as $photo)
                    @if($i == 1)
                        <div class="col-12 carousel-item active" style="width:1050px; height:500px;">
                            <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                        </div>
                    @else
                        <div class="col-12 carousel-item" style="width:1050px; height:500px;">
                            <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                        </div>
                    @endif   
                    @php($i++)
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endif
<div class="row col-12 groupList mb-3">
    <div class="row col-12 justify-content-center m-0 p-0 mt-3">
        <div class="mb-1 justify-content-center" style="width:100%; font-size:32px; text-align:center;">Komentarze</div>
        <div class="row col-12 ">
            @if(!$business->comments->isEmpty())
                @foreach($business->comments as $comment)
                <div class="w-100 mb-1 p-2">
                    <div class="mb-2 d-flex flex-row" style="color:#444956; border-bottom:1px solid #ddd; padding-bottom:15px;">
                            <img src="{{asset('storage/'.$comment->user->photos->path)}}" width="60" height="60" class="rounded-circle border mt-2" alt="avatar">
                        <div class="flex-column">
                            <div class="mt-2 ml-3">
                                <span style="font-size:20px;">{{$comment->user->contactable[0]->name}}</span> <span style="color:gold;">{!! $comment->rating['str'] !!} </span>
                                <div style="font-size:14px;">{{$comment->updated_at}}</div>
                            </div>
                            <div class="pl-3 pt-2">
                                {{$comment->content}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="mb-1 justify-content-center" style="width:100%; font-size:24px; text-align:center;">Brak komentarzy</div>
            @endif
        </div>
    </div>

      <div class="row w-100 justify-content-center">
         @can('isUser')
            @if(!($userComent = $business->comments->where('user_id',auth()->user()->id))->isEmpty())
                <form method="POST" action="{{ route('editComment',['commentable_id'=>$business->id, 'App\Models\Business']) }}" class="form-horizontal">
                    <fieldset>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-8 control-label" style="font-size:20px;">Zmień swoją opinię</label>
                        <div class="col-lg-10">
                            @foreach($userComent as $content)
                                <textarea required name="content" class="form-control" rows="3" id="textArea">{{$content->content}}</textarea>
                                @break
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectRating" class="col-lg-2 control-label" style="font-size:20px;">Ocena</label>
                        <div class="col-lg-10">
                            <select name="rating" class="form-control" id="selectRating">
                                @foreach($userComent as $content)
                                    
                                    <option value="5" @if($content->rating['value'] == 5) selected @endif>5</option>
                                    <option value="4" @if($content->rating['value'] == 4) selected @endif>4</option>
                                    <option value="3" @if($content->rating['value'] == 3) selected @endif>3</option>
                                    <option value="2" @if($content->rating['value'] == 2) selected @endif>2</option>
                                    <option value="1" @if($content->rating['value'] == 1) selected @endif>1</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-rating"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{ route('deleteComment',['commentable_id'=>$business->id, 'App\Models\Business']) }}" class="btn btn-danger">Usuń opinię</a>
                            <button type="submit" class="btn btn-primary">Zmień opinię</button>
                        </div>
                    </div>
                    
                    </fieldset>
                    {{ csrf_field() }}
                </form>
            @else
                <form method="POST" action="{{ route('addComment',['commentable_id'=>$business->id, 'App\Models\Business']) }}" class="form-horizontal">
                    <fieldset>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-8 control-label" style="font-size:20px;">Dodaj swoją opinię</label>
                        <div class="col-lg-10">
                            <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectRating" class="col-lg-2 control-label" style="font-size:20px;">Ocena</label>
                        <div class="col-lg-10">
                            <select name="rating" class="form-control" id="selectRating">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="my-rating"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Dodaj opinię</button>
                        </div>
                    </div>
                    
                    </fieldset>
                    {{ csrf_field() }}
                </form>
            @endif
         @elseif(!'isBusiness')
         <a href="{{ route('login') }}">Zaloguj się aby dodać komentarz</a>
         @endcan
      </div>
</div>
@if(!$business->questionsAndAnswers->isEmpty())
    <div class="row col-12 groupList mb-3">
        <div class="row col-12 justify-content-center mt-3">
            <div class="mb-1" style="font-size:32px;">Pytania i odpowiedzi </div>
        </div>
    
      <div class="row col-12 ">
        @foreach($business->questionsAndAnswers as $qAndA)
            <div class="w-100 mb-1 p-2">
                <div class="mb-1 d-flex flex-row" style="color:#444956; border-bottom:1px solid #ddd; padding-bottom:15px;">
                    <div class="flex-column">
                    <span style="font-size:16px; font-weight:600;">{{$qAndA->question}}</span><br>
                    <span style="font-size:15px;">{{$qAndA->answer}}</span><br>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
   </div>
@endif
    </div>
@endsection
@push('calendar')
<script>

    $(".service-title").each(function () {
        var numChars = $(this).text().length;     
        console.log(numChars);
        if ((numChars >= 28)) {
            $(this).css("font-size", "1em");
        }       
    });
</script>
@endpush
