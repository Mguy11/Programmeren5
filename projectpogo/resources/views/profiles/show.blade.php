@extends('layouts.app')

@section('content')
    <a href="/profiles" class="btn btn-primary btn-default">Terug</a>
    <hr>
    <img class="card-img-top" style="width:50% height:50%" src="/storage/profile_images/{{$profile->profile_image}}" alt="Card image cap">
    <h1>{{$profile->name}}</h1>
    <div class="container">
            <p><b>Level:</b> {{$profile->level}}</p>
            <p><b>Friendcode:</b> {{$profile->friendcode}}</p>
            <p>Team <b>{{$profile->team}}</b> uit <b>{{$profile->city}}</b></p>
    </div>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $profile->user_id)
        <a href="/profile/{{$profile->id}}/edit" class="btn btn-primary btn-default">Edit</a>
        {!! Form::open(['action' => ['ProfilesController@destroy',$profile->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' =>'btn btn-danger btn-default'])}}
        {!! Form::close()!!}
        @endif
    @endif
                  
@endsection