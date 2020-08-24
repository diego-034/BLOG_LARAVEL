@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center mt-5">
                <div class="card-header">
                    <a href="/profile/{{ $response['P'][0]->user_id}}">{{$response['P'][0]->name}}</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="/post/{{$response['P'][0]->post_id}}">{{$response['P'][0]->post_title}}</a></h5>
                    <p class="card-text">{{$response['P'][0]->post_body}}</p>
                    <form action="/comment" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="row">

                                <div class="col-10">
                                    <input type="text" class="form-control" name="comment" placeholder="Comment" required>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary" name="post_id" value="{{$response['P'][0]->post_id}}">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if(isset($response['C'][0]))
                    <ul class="list-group">
                        @foreach($response['C'] as $comment)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-3">
                                    <a href="/profile/{{$comment->user_id}}"><strong>{{$comment->name}} </strong></a>
                                </div>
                                <div class="col-9">
                                    {{$comment->comment}}
                                </div>
                            </div>
                        </li>
                        @can('update_delete', $comment)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-10">
                                    <form id="update-comment{{  $comment->comment_id}}" action="/comment/update/{{ $comment->comment_id }}" method="POST">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="comment" value="{{$comment->comment}}">
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary" value="{{$response['P'][0]->post_id}}" name="post_id">Update</button>
                                            </div>
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault();if(confirm('Are you secure?')){document.getElementById('delete-comment{{ $comment->comment_id}}').submit();};
                                                     ">Delete</button>
                                    <form id="delete-comment{{  $comment->comment_id}}" action="{{ url('/comment') }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        <input name="comment_id" value="{{$comment->comment_id}}">
                                        <input name="post_id" value="{{$response['P'][0]->post_id}}">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endcan
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection