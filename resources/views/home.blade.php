@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center p-3">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <a class="btn btn-primary" href="{{ route('post.new') }}" role="button">post</a>
        </div>
    </div>

    <div class="p-3">
        <h3>Your post</h3>
        @forelse($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><a
                            href="{{ url('/'. $post->user_id . '/posts/' . $post->id) }}">{{ $post->title }}</a></h4>
                    <div class="card-subtitle">
                        <small class="text-right font-weight-light">posted at {{ $post->created_at }}</small>
                    </div>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
            </div>
        @empty
            <p>There is no your post.</p>
        @endforelse
    </div>

</div>
@endsection
