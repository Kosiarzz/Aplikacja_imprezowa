@extends('layouts.app')

@section('content')
<div class="container">
            <div class="row">
                @foreach($businesses as $business)
                    <a href="{{ route('business.id', ['id' => $business->id]) }}" class="col-4 boxBusiness">
                        <div class="businessBoxTitle">
                            {{$business->title}}
                        </div>
                        <div class="businessBoxNotifications">
                            20
                        </div>
                    </a>
                @endforeach
                <a href="{{ route('business.category') }}" class="col-4 businessBoxDefault">Dodaj usługę</a>
            </div>
            

</div>
@endsection
