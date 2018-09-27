@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary btn-default">Terug</a>
    <h1>{{$post->title}}</h1>
    <div class="container">
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>

                  
@endsection