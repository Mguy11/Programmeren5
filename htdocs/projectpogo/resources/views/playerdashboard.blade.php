@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Overview</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="container">
                            <a href="/profiles/create" class="btn btn-primary btn-default">Create Profiile</a>
                            <h3>Your Profiles</h3>
                            @if(count($profiles) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th></th>
                                        <th>Aan/Uit</th>
                                    </tr>
                                    @foreach ($profiles as $profile)
                                        <tr>
                                            <td>{{$profile->name}}</td>
                                            <td><a href="/profiles/{{$profile->id}}/edit" class="btn btn-primary btn-default">Edit</a></td>
                                            <td>
                                                {!! Form::open(['action' => ['ProfilesController@destroy',$profile->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' =>'btn btn-danger btn-default'])}}
                                                {!! Form::close()!!}</td>
                                            <td><input type="checkbox" checked data-toggle="toggle"><td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <p>You have no profiles.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
