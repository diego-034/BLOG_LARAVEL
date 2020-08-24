<div class="row justify-content-center">
    <div class="col-md-10">

        <div id="posts">
            @foreach($response['OK'] as $post)

            <div class="card text-center mt-5 shadow-lg">
                <div class="card-header">
                    <a href="/profile/{{ $post->user_id }}">{{$post->name}}</a>
                </div>
                <div class="card-body">
                    @if(isset($status))
                    <h5 class="card-title"><a href="/post/{{ $post->post_id }}">{{$post->post_title}}</a></h5>
                    <p class="card-text">{{$post->post_body}}</p>
                    @else
                    @can('see-post', $post)
                    <form method="POST" class="mb-3" action="/post/update/{{$post->post_id }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Title</label>
                            <input class="form-control" name="post_title" type="text" value="{{$post->post_title}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Content</label>
                            <textarea class="form-control" name="post_body">{{$post->post_body}}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                                                     if(confirm('Are you secure?')){document.getElementById('delete-form{{ $post->post_id}}').submit();}">Delete</button>

                    <form id="delete-form{{ $post->post_id}}" action="{{ route('post') }}" method="POST" style="display: none;">
                        @method('DELETE')
                        <input name="post_id" value="{{ $post->post_id }}">
                        @csrf
                    </form>
                    @endcan
                    @endif
                </div>

            </div>

            @endforeach
        </div>
    </div>
</div>