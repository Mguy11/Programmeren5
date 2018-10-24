@extends('layouts.app')

@section('content')
    <h1>Create Profile</h1>
    {!! Form::open(['action' => 'ProfilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
                {{Form::label('level', 'Level')}}
                {{Form::text('level', '', ['class' => 'form-control', 'placeholder' => '30'])}}
        </div>
        <div class="form-group">
                    {{Form::label('team', 'Team')}}
                    {{Form::text('team', '', ['class' => 'form-control', 'placeholder' => 'Red/Blue/Yellow'])}}
        </div>
        <div class="form-group">
                {{Form::label('city', 'City')}}
                {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'City'])}}
        </div>
        <div class="form-group">
                {{Form::label('friendcode', 'Friendcode')}}
                {{Form::text('friendcode', '', ['class' => 'form-control', 'placeholder' => '0000 0000 0000'])}}
        </div>
        <div class="form-group">
            {{Form::file('profile_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}                
@endsection