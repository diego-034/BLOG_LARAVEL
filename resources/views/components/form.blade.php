<div id="form_post" style="display: none;">
    <form action="{{ url('/publish')}}" method="POST">
    @csrf
        <label for="exampleFormControlInput1">New Post</label>

        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input class="form-control" name="post_title" type="text" placeholder="Title">
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" name="post_body" placeholder="Content" rows="3"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Send</button>

    </form>
</div>