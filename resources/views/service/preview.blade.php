@extends('layouts.service')
@section('content')
<div class="container mt-5">

   <div class="titlePage mb-3 mt-5 col-12" style="text-align:center;">
         Podgląd na liście wyszukiwania
    </div>


      <div class="row col-12 groupList p-2 mb-3" style="height:215px;">
            <div class="col-md-4 p-0 searchPage">
                
                @if($business->photos->isEmpty())
                    <img src="{{asset('storage/photos/test.png')}}" class="card-img" alt="zdjęcie">
                @else
                    <img src="{{asset('storage/'.$business->photos->first()->path)}}" class="card-img" alt="zdjęcie">
                @endif
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between pl-3 h5">
                        <div class="" style="font-size:20px; color:#333740;">
                            {{str_limit($business->title, 55)}}
                        </div>
                    </div> 
               </div>
               <div class="row">
                  <div class="col-md-8 pl-3">
                        <div class="mb-1" style="font-size:18px; color:#3F4756;"><span style="margin-right:10px;">{{str_limit($business->mainCategory->name, 17)}}, {{$business->city->name}} </span>
                                @for($i=1; $i<=5; $i++)
                                    @if($rate >= $i)
                                        <i class="fas fa-star" style="color:gold; font-size:15px;"></i>
                                    @else
                                        <i class="fas fa-star" style="color:gray; font-size:15px;"></i>
                                    @endif
                                @endfor
                                <span style="color:#000; font-size:16px;">({{count($business->comments)}})</span>
                        </div>
                        <div class="" style="height:110px; font-size:14px;">{{str_limit($business->short_description, 330)}}</div>
                  </div>
                  <div class="col-md-4 mb-0 justify-content-center">
                     <div class="" style="text-align:center;">
                            @if($business->services->min('price_from') == $business->services->max('price_to'))
                                <span style="color:#333740;">Oferta</span> <br> od <span class="money">{{$business->services->min('price_from')}}</span> zł
                            @else
                                <span style="color:#333740; font-size:20px;">Oferty</span> <br> od <span class="money">{{$business->services->min('price_from')}}</span> zł do <span class="money">{{$business->services->max('price_to')}}</span> zł
                            @endif
                     </div>
                  </div>
                  <div class="col-8 pl-3 pr-1" style="font-size: 14px;"> 
                        @foreach($partyCategory as $pCategory)
                            @foreach($pCategory->groupCategory as $gCategory)
                                <span style="background:#009D91; color:#fff; border-radius:15px; padding:2px 8px; margin-right:3px;">{{$gCategory->category[0]->name}}</span>
                            @endforeach
                        @endforeach
                  </div>
               </div>
            </div>
         
      </div>
        @php($sumRating = 0)
        @foreach($business->comments as $comment)
            {{$comment->ratin}}
        @endforeach
        
    <div class="titlePage mb-3 col-12" style="text-align:center;">
         Podgląd strony
    </div>
    <div class="row col-12 groupList mb-3 pb-2">
        <div class="row col-12 justify-content-center">
        <section class="col-12 border-bottom">
            <div class="p-3 titleBusiness" style="font-size:30px; text-align:center;">
                {{$business->title}}						
            </div>
            <div style="text-align:center; color:gold;">
                @for($i=1; $i<=5; $i++)
                    @if($rate >= $i)
                        <i class="fas fa-star" style="color:gold;"></i>
                    @else
                        <i class="fas fa-star" style="color:gray;"></i>
                    @endif
                @endfor
                <span style="color:#000;">({{count($business->comments)}})</span>
            </div>
            <hr>    
            <div class="description mt-2 p-2" style="color:#444956; font-size:15px; white-space: pre-line; text-align:left;">{{$business->description}}</div>
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
      <div class="row col-12 pl-4 ml-1 mt-2" style="padding-left:80px!important;">
        @foreach($business->services as $service)
            <a href="{{route('service.serviceDetails', ['id' => $service->id])}}" class="mb-4 mr-3 py-2 pl-1 pr-1 groupList" style="width:250px; color:#444956; text-decoration:none; text-align:center;">
                <div style="min-height:140px!important;">
                    @foreach($service->photos as $photo)
                        <img src="{{asset('storage/'.$photo->path)}}" width="240" height="141" alt="zdjęcie"><br>
                        @break
                    @endforeach
                    @if($service->photos->isEmpty())
                        <img src="{{asset('storage/default/photo.jpg')}}" width="240" height="141" alt="zdjęcie"><br>
                    @endif
                </div>
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

<div class="row col-12 groupList mb-3">
   <div class="row justify-content-center mt-3">
   
      <div class="mb-1" style="font-size:32px;">Galeria zdjęć</div>
      <div id="carouselExampleControls" class="carousel slide pl-1 border-bottom pb-4" data-ride="carousel">
        <div class="carousel-inner" style="width:900px; height:500px;">
            @php($i = 1)
            @foreach($business->photos as $photo)
                @if($i == 1)
                    <div class="col-12 carousel-item active" style="width:900px; height:500px;">
                        <img class="d-block w-100" style="width:100%; height:100%;" src="{{asset('storage/'.$photo->path)}}" alt="Zdjęcie">
                    </div>
                @else
                    <div class="col-12 carousel-item" style="width:900px; height:500px;">
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

<div class="row col-12 groupList mb-3">
    <div class="row col-12 justify-content-center mt-3">
        <div class="mb-1 col-12" style="font-size:32px; text-align:center;">Komentarze</div>
        <div class="row col-12 ">
            @if(!$business->comments->isEmpty())
                @foreach($business->comments as $comment)
                <div class="w-100 mb-1 p-2">
                    <div class="mb-2 d-flex flex-row" style="color:#444956; border-bottom:1px solid #ddd; padding-bottom:15px;">
                        @if(isset($comment->user->photos))
                        <img src="{{asset('storage/'.$comment->user->photos->path)}}" width="60" height="60" class="rounded-circle border mt-2" alt="avatar">
                    @else
                        <img src="{{asset('storage/default/defaultAvatar.png')}}" width="60" height="60" class="rounded-circle border mt-2" alt="avatar">
                    @endif
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
            <div class="col-12" style="text-align:center;">
                Brak komentarzy
            </div>
            @endif
        </div>
    </div>
</div>

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

    <div class="row col-12 content-justify-center mt-3" style="text-align:center;">
        <a href="{{route('service.businessEdit', ['id' => $business->id])}}" class="btn btn-primary mr-3">Edytuj</a>
        <a href="{{route('service.businessDelete', ['id' => $business->id])}}" class="btn btn-danger">Usuń usługę</a>
    </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $( "a" ).removeClass( "active" );
    $("#preview").addClass("active");

    $(".service-title").each(function () {
        var numChars = $(this).text().length;     
        console.log(numChars);
        if ((numChars >= 25)) {
            $(this).css("font-size", "1.0em");
        }       
    });

    var money = document.getElementsByClassName("money");
    
    for(var i = 0; i < money.length; i++) {
    
        result = numberWithSpaces(money[i].innerText);
        document.getElementsByClassName("money")[i].innerText = result;
    }

    function numberWithSpaces(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

</script>
@endpush