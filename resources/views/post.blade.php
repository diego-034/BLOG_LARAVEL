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
                                    <input type="text" class="form-control" name="comment" placeholder="Comment">
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
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection