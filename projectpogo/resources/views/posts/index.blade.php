@extends('layouts.app')

@section('content')
<br>
<form action="{{route('search')}}" method="GET" class="search-form">
    <div class="container">
        <label for="search">Search on Title:</label>
        <br>
        <input type="text" name="search" class="from-control" id="search">
        <br>
        <div class="form-group">
            <label for="sel1">Select category:</label>
            <select name="category" class="form-control" id="sel1">
                <option>All categories</option>
                <option>Community Day</option>
                <option>Event</option>
                <option>Patch Notes</option>
            </select>
        </div>
        <button class="" type="submit">Search</button>
    </form>
</div>
    <br>
    <div class="album py-5 bg-light">
        <div class="container">
                <h1>Posts</h1>
                @if(count($posts) > 0)
                <div class="row">
                        @foreach($posts as $post)
                            @if($post->post_state !== 0)
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <img class="card-img-top" href="/posts/{{$post->id}}" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                                    <br>
                                        <div class="card-body">
                                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                            <p class="card-text">{!!$post->body!!}</p>
                                            <a class="btn btn-primary" href="/posts/{{$post->id}}">Read</a>
                                            <hr>
                                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small> 
                                            <br>
                                        </div>
                                        
                                </div>
                            </div>
                            @endif
                            @endforeach
                </div> 
                {{$posts->links()}}
                @else 
                    <p>No posts found</p>
                @endif
        </div>
    </div>
@endsection



   
              
                
                  
        