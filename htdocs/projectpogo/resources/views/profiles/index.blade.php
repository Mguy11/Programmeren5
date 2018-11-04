@extends('layouts.app')

@section('content')
    <hr>
    <h1>Players</h1>
    <div class="album py-5 bg-light">
            <div class="container">

                @if(count($profiles) > 0)
                <div class="row">
                    @foreach($profiles as $profile)
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <img class="card-img-top" src="/storage/profile_images/{{$profile->profile_image}}" alt="Card image cap">
                                    <br>
                                        <div class="card-body">
                                            <h3><a href="/profiles/{{$profile->id}}">{{$profile->name}}</a></h3>
                                            <p><b>Level:</b> {{$profile->level}}</p>
                                            <p><b>Friendcode:</b> {{$profile->friendcode}}</p>
                                            <small>Team <b>{{$profile->team}}</b> uit  <b>{{$profile->city}}</b></small>
                                        </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                {{$profiles->links()}}
                @else 
                    <p>No Players found</p>
                @endif
            </div>
    </div>       
@endsection