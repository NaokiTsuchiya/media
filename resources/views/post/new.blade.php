@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('post.form', ['action' => route('post.create')])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
