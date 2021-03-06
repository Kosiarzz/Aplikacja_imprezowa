@extends('layouts.event')
@section('content')
<div class="container mt-5">
   <div class="titlePage mb-4">
         Wybrane usługi
      </div>
   <div class="row justify-content-center">
   </div>
   <div class="row col-md-12">
      @foreach($services as $service)
        @foreach($service->groupCategory as $categories)
            @foreach($categories->category as $mainCategory)
                <a href="{{ route('event.servicesDetails', ['idCategory' => $mainCategory->id])}}" class="serviceBoxButton">
                    <div class="serviceBoxTitle">
                        {{$mainCategory->name}}
                    </div>
                </a>
            @endforeach
        @endforeach
      @endforeach
   </div>
   <div class="row col-12">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServices">Wybierz usługi</button>
      <div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header mb-3">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Usługi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form method="POST" action="{{ route('addMainCategoryGroup') }}">
                  @csrf
                  
                  @foreach($mainCategories as $mainCategory)
                    @foreach($mainCategory->groupCategory as $gCategory)
                        @foreach($gCategory->category as $category)
                            <div class="custom-control custom-switch ml-2 mt-2">   
                                <input class="custom-control-input" type="checkbox" value="{{$category->id}}" id="flexCheckDefault{{$category->id}}" name="mainCategories[]">
                                <label class="custom-control-label ml-2" for="flexCheckDefault{{$category->id}}">
                                {{$category->name}}
                                </label>
                            </div>
                            <input id="group" type="hidden" class="form-control @error('group') is-invalid @enderror" name="group" value="{{ $services[0]->id }}" required>
                        @endforeach
                    @endforeach
                  @endforeach
                  <div class="modal-footer mt-3">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                     <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 titlePage text-center mb-3 mt-5 border-top pt-2">
      Inni użytkownicy wybrali również 
   </div>
   <div class="row col-md-12">
      @foreach($statisticCategories as $statisticCategory)
      <a id="stats{{$statisticCategory->category_id}}" href="{{ route('event.servicesDetails', ['idCategory' => $statisticCategory->category_id])}}" class="serviceBoxButton">
         <div class="serviceBoxTitle">  
            {{$statisticCategory->category->name}}
         </div>
      </a>
      @endforeach
   </div>
</div>
@endsection

@push('script')
<script>
   $( "a" ).removeClass( "active" );
   $("#service").addClass("active");
   
   @foreach($services as $service)
         @foreach($service->groupCategory as $categories)
            @foreach($categories->category as $mainCategory)
                $( "#flexCheckDefault{{$mainCategory->id}}" ).attr( "checked", true);
                $( "#stats{{$mainCategory->id}}" ).remove();
            @endforeach
        @endforeach
    @endforeach
</script>
@endpush