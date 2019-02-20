@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>{{ $post->title }}</div>
                <div>{{ $post->content }}</div>
            </div>

        </div>

    </div>

@endsection
