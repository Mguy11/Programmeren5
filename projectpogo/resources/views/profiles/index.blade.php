@extends('layouts.app')

@section('content')
    <hr>
    <h1>Players</h1>
    <div class="album py-5 bg-light">
            
                @if(count($profiles) > 0)
                @foreach($profiles as $profile)
                <div class="row">
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
                      </div>
                @endforeach
                {{$profiles->links()}}
                @else 
                    <p>No Players found</p>
                @endif
                  
@endsection



   
              
                
                  
        