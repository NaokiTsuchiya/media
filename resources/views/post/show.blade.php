@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>{{ $post->title }}</div>
                <div>{{ $post->content }}</div>
                @if(Auth::user()->id === $user->id)
                    <div>
                        <a name="" id="" class="btn btn-primary" href="{{route('post.edit', $post->id)}}" role="button">編集</a>
                        <form action="{{ route('post.delete', $post->id) }}" method="post">
                            <button type="submit" class="btn btn-danger">削除</button>
                            @csrf
                        </form>
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection