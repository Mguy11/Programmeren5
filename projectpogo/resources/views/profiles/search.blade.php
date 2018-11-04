@extends('layouts.app')

@section('content')

    <form action="profiles/search" method="GET" class="search-form">
        <label for="search">Search on Name:</label>
        <br>
        <input type="text" name="search" class="from-control" id="search">
        <br>
        <button class="" type="submit">Search</button>
    </form>

    <hr>
            <div class="search-container">
            <h1>Results</h1>
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
@endsection