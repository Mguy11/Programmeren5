@extends('layouts.app')

@section('content')


        <form action="posts/search" method="GET" class="search-form">
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

        <div class="search-container">
            <h1>Results</h1>
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
@endsection



   
              
                
                  
        