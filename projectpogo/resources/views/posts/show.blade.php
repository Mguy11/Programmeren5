@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary btn-default">Terug</a>
    <h1>{{$post->title}}</h1>
    <img class="card-img-top" style="width:50%" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
    <br>
    <div class="container">
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-default">Edit</a>
        {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' =>'btn btn-danger btn-default'])}}
        {!! Form::close()!!}
        @endif
    @endif
                  
@endsection