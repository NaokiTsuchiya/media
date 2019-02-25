<form method="post" action="{{ $action }}">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" @isset($post)value="{{$post->title}}"@endisset aria-describedby=""
               placeholder="This is title of this post.">
        <small id="" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" rows="10">@isset($post){{$post->content}}@endisset</textarea>
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
    @csrf
</form>
