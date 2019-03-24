@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h3>Your posts</h3>
    @if(count($posts) === 0)
        <p>There is no your post.</p>
    @else
        <div class="list-group">
            @foreach($posts as $post)
                <div class="list-group-item">
                    <div class="list-item-header d-flex align-items-end">
                        <h4 class="mb-0 mr-5 list-item-title">
                            <a href="{{ url('/'. $post->user_id . '/posts/' . $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h4>
                        <div class="list-item-dateTime">
                            posted at {{ $post->created_at }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    @endif
</div>
@endsection
