@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">Редагувати коментар</div>

        <div class="card-body">
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Content</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $comment->content }}">
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
    </div>
@endsection