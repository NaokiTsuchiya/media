<form method="post" action="{{ $action }}">
    <div class="form-group">
        <label for="title">Title</label>
        <input
            type="text"
            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
            name="title"
            id="title"
            value="@if(old('title') !== null){{ old('title') }}@elseif(isset($post)){{$post->title}}@endif"
            aria-describedby=""
            placeholder="This is title of this post."
        >
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea
            class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
            name="content"
            id="content"
            rows="10"
        >@if(old('content') !== null){{ old('content') }}@elseif(isset($post)){{$post->content}}@endif</textarea>
        @if ($errors->has('content'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">投稿</button>
    @csrf
</form>
