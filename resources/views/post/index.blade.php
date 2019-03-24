@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Recent Posts</h1>
        <div class="list-group mb-4">
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
    </div>
@endsection
