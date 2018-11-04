@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

        <div class="form-group">
                <label for="sel1">Select category:</label>
                <select name="category" class="form-control" id="sel1">
                        <option>All categories</option>
                        <option>Community Day</option>
                        <option>Event</option>
                        <option>Patch Notes</option>
                </select>
        </div>

        <div class="form-group">
               {{Form::file('cover_image')}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}                
@endsection