@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary btn-default">Terug</a>
    <h1>{{$post->title}}</h1>
    <div class="container">
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-default">Edit</a>
    {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' =>'btn btn-danger btn-default'])}}
    {!! Form::close()!!}

                  
@endsection