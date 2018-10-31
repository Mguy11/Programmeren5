@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <div class="album py-5 bg-light">
        <div class="container">
            
                @if(count($posts) > 0)
                <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                                    <br>
                                        <div class="card-body">
                                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                            <p class="card-text">{!!$post->body!!}</p>
                                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> 
                                        </div>
                                </div>
                            </div>
                            @endforeach
                </div> 
                {{$posts->links()}}
                @else 
                    <p>No posts found</p>
                @endif
        </div>
    </div>
@endsection



   
              
                
                  
        