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
                    <div class="col-md-12 d-flex justify-content-between pl-3 h4">
                        <div class="">
                            {{str_limit($business->title,55)}}
                        </div>
                        <div class="">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div> 
               </div>
               <div class="row">
                  <div class="col-md-8 pl-3">
                     <h5 class="card-title">{{$business->mainCategory->name}}, {{$business->city->name}} 
                     @for($i=1; $i<=5; $i++)
                        @if($rate >= $i)
                            <i class="fas fa-star" style="color:gold; font-size:16px;"></i>
                        @else
                            <i class="fas fa-star" style="color:gray; font-size:16px;"></i>
                        @endif
                    @endfor
            <span style="color:#000; font-size:16px;">({{count($business->comments)}})</span>
                     </h5>
                     <h6 class="card-title"  style="height:90px;">{{$business->short_description}}</h6>
                  </div>
                  <div class="col-md-4 mb-0">
                     <h5 class="card-title">
                         @foreach($business->services as $service)
                            od {{$service->price_from}} zł do {{$service->price_from}} zł / {{$service->unit}}
                            @break
                         @endforeach
                     </h5>
                  </div>
                  <div class="col-8 pl-3 pr-1" style="font-size: 14px;"> 
                        @foreach($partyCategory as $pCategory)
                            @foreach($pCategory->groupCategory as $gCategory)
                                <span style="background:#eff3f6; border-radius:15px; padding:2px 8px; margin-right:3px;">{{$gCategory->category[0]->name}}</span>
                            @endforeach
                        @endforeach
                  </div>

                  <div class="col-8 pl-3 pr-1" style="font-size: 14px;"> 

                   
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
    <div class="row col-12 groupList">
    <div class="row col-12 justify-content-center">
      <section class="col-12">
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
         <div class="description mt-2 p-2" style="color:#444956; font-size:15px;">{{$business->description}}</div>
      </section>
      @foreach($additionalCategory as $aCategory)
                        @foreach($aCategory->groupCategory as $gCategory)
                        {{$gCategory->category[0]->name}},
                        @endforeach
                    @endforeach
                    @foreach($userCategory as $uCategory)
                        @foreach($uCategory->groupCategory as $gCategory)
                        {{$gCategory->category[0]->name}},
                        @endforeach
                    @endforeach
      
   </div>

   <div class="row justify-content-center mt-3">
   
      <div class="mt-2" style="font-size:32px;">Galeria zdjęć</div>
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
      

      <div id="services" class="row mt-4">
         <h2>
            Oferty
         </h2>
      </div>
      <div class="row col-12 pl-4 ml-1 border-bottom">
        @foreach($business->services as $service)
        <a href="{{route('serviceDetails', ['id' => $service->id])}}" class="mb-4 mr-3 groupList" style="width:250px; color:#444956; text-decoration:none;">
                @foreach($service->photos as $photo)
                    <img src="{{asset('storage/'.$photo->path)}}" width="250" height="141" alt="zdjęcie"><br>
                    @break
                @endforeach
                <div class="mt-1 mb-1" style="text-align:center; font-size:20px; color:#444956;">{{$service->title}}</div>
                <div class="">od {{$service->price_from}} zł do {{$service->price_to}} zł / {{$service->unit}}</div>
                <div class=""></div>
                <div class=""></div>
                Osób od: {{$service->people_from}}<br>
                Osób do: {{$service->people_to}}<br>      
                Metraż: {{$service->size}} m^2<br> 
        </a>
        @endforeach
      </div>

      <div class="row col-12 justify-content-center mt-5 border-bottom">
         <div class="line-overflow clearfix">
            <h2>Kontakt</h2>
         </div>
         <div class="row w-100 justify-content-center">
            <address class="business-card">
                <div class="item">
                    Nazwa firmy: {{$business->name}}							
                </div>
                <div class="item"> 
                    Imię i nazwisko: {{$business->contactable[0]->name}} {{$business->contactable[0]->surname}}<br>
                    Telefon:  {{$business->contactable[0]->phone}}
                </div>
                <div class="item">
                    Adres: {{$business->address->street}}, {{$business->address->post_code}}
                    {{$business->city->name}}
                </div>
                <a href="{{$business->social->www}}"><i class="fas fa-globe" style="font-size:26px; color:#000;"></i></a>
                <a href="{{$business->social->facebook}}"><i class="fab fa-facebook-f" style="font-size:26px; color:#000;"></i></a>
                <a href="{{$business->social->instagram}}"><i class="fab fa-instagram" style="font-size:28px; color:#000;"></i></a>
                <a href="{{$business->social->youtube}}"><i class="fab fa-youtube" style="font-size:28px; color:#000;"></i></a>
            </address>
         </div>
      </div>

        <div class="row mt-5">
            <h2>
                Komentarze<span style="font-size:22px;">({{count($business->comments)}})</span>
            </h2>
            <hr>
        </div>
        <div class="row col-12 ">
            @foreach($business->comments as $comment)
            <div class="w-100 mb-1 p-2">
                <div class="mb-4 d-flex flex-row" style="color:#444956; border-bottom:1px solid #ddd; padding-bottom:15px;">
                    <a href="{{route('findUserProfile', ['id' => $comment->user->id])}}">
                        <img src="{{asset('storage/'.$comment->user->photos->path)}}" width="100" height="100" class="rounded-circle border" alt="SALA">
                    </a>
                    <div class="flex-column">
                        <div class="mt-2 ml-3">
                        <span style="font-size:20px;">{{$comment->user->contactable[0]->name}}</span> <span style="color:gold; font-size:23px;">{!! $comment->rating['str'] !!} </span>
                            <div style="font-size:14px;">{{$comment->updated_at}}</div>
                        </div>
                        <div class="pl-3 pt-2">
                            {{$comment->content}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        


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
    
      <div class="row col-12 ">
        @foreach($business->questionsAndAnswers as $qAndA)
            <div class="w-100 mb-1 p-2">
                <div class="mb-1 d-flex flex-row" style="color:#444956; border-bottom:1px solid #ddd; padding-bottom:15px;">
                    <div class="flex-column">
                    <span style="font-size:24px;">{{$qAndA->question}}</span><br>
                    <span style="font-size:18px;">{{$qAndA->answer}}</span><br>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

      <!--
         mapa
         
         -->
   </div>
   </div>
    <div class="row col-12 content-justify-center mt-3" style="text-align:center;">
        <a href="{{route('service.businessEdit', ['id' => $business->id])}}" class="btn btn-primary mr-3">Edytuj</a>
        <a href="{{route('service.businessDelete', ['id' => $business->id])}}" class="btn btn-danger">Usuń usługę</a>
    </div>

</div>
@endsection
@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#preview").addClass("active");
</script>
@endpush