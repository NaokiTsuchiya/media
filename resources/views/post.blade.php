@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('post') }}">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" aria-describedby=""
                               placeholder="This is title of this post.">
                        <small id="" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">投稿</button>
                    @csrf
                </form>
            </div>

        </div>

    </div>

@endsection
