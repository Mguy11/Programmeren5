@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if(count($posts) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th>Hide</th>
                                    </tr>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{$post->title}}</td>
                                            <td>
                                                {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::submit('Delete', ['class' =>'btn btn-danger btn-default'])}}
                                                {!! Form::close()!!}</td>
                                            <td>
                                                <form action="{{action('PostsController@hidePost')}}", method="POST", enctype="multipart/form-date">
                                                <label class="switch">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$post->id}}">
                                                    <input type="checkbox" name="hide" <?php if($post->post_state == 1){ ?> checked <?php } ?>>
                                                    <span class="slider round"></span>     
                                                </label>
                                            <td>
                                        </tr>
                                    @endforeach
                                </table>
                                <button class="" type="submit">Save</button>
                            </form>
                            @else
                                <p>You have no posts.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
