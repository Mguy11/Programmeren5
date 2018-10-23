@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <div class="album py-5 bg-light">
            
                @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                            <br>
                                <div class="card-body">
                                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                <p class="card-text">{!!$post->body!!}</p>
                                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> 
                                </div>
                                
                                <!--<div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a role="button" class="btn btn-sm btn-outline-secondary" href="/posts/{{$post->id}}">View</a>
                                    <a role="button" class="btn btn-sm btn-outline-secondary" href="#">Edit</a>
                                </div>
                            </div>-->
                          </div>
                        </div>
                      </div>
                @endforeach
                {{$posts->links()}}
                @else 
                    <p>No posts found</p>
                @endif
                  
@endsection



   
              
                
                  
        