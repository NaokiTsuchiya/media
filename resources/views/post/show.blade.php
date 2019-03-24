@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="post bg-white p-5">
            <div class="post-header">
                <div class="d-flex align-items-end">
                    <div class="mr-3 font-weight-bold lead">{{ $user->name }}</div>
                    <div class="mr-3 align-middle">Posted at:{{$post->created_at}}</div>
                    @if(Auth::id() === $user->id)
                        <div class="ml-auto">
                            <div class="row justify-content-end">
                                <a class="btn btn-primary col-auto" href="{{route('post.edit', $post->id)}}"
                                   role="button">編集</a>
                                <form class="col-auto" action="{{ route('post.delete', $post->id) }}" method="post">
                                    <button type="submit" class="btn btn-danger">削除</button>
                                    @csrf
                                </form>
                            </div>

                        </div>

                    @endif
                </div>

            </div>
            <div class="post-body">
                <h1 class="mt-0 mb-4">{{ $post->title }}</h1>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
@endsection
