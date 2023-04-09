@extends('layouts.sidebar')

@section('content')

    <div class="bg-white p-4 rounded">
        <div class="container text-center">
            <div class="card" style="width: 25rem;">
                                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                <ul class="list-group list-group-flush">

                    <li class="list-group-item">Category: {{ $post->category->name ?? '' }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('post.show') }}" class="btn btn-outline-secondary shadow-none">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection