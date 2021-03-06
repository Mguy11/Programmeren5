@extends('layouts.app')

@section('content')
    <h1>Edit Profile</h1>
    {!! Form::open(['action' => ['ProfilesController@update',$profile->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $profile->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
                {{Form::label('level', 'Level')}}
                {{Form::text('level', $profile->level, ['class' => 'form-control', 'placeholder' => '30'])}}
        </div>
        <div class="form-group">
                    {{Form::label('team', 'Team')}}
                    {{Form::text('team', $profile->team, ['class' => 'form-control', 'placeholder' => 'Valor/Mystic/Instinct'])}}
        </div>
        <div class="form-group">
                {{Form::label('city', 'City')}}
                {{Form::text('city', $profile->city, ['class' => 'form-control', 'placeholder' => 'City'])}}
        </div>
        <div class="form-group">
                {{Form::label('friendcode', 'Friendcode')}}
                {{Form::text('friendcode', $profile->friendcode, ['class' => 'form-control', 'placeholder' => '0000 0000 0000'])}}
        </div>
        <div class="form-group">
            {{Form::file('profile_image')}}
        </div>
        <div class="form-group">
                {{Form::file('profile_qr')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}                
@endsection