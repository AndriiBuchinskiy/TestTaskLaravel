@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">Редагувати коментар</div>

        <div class="card-body">
            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                <!-- Додати наступний рядок для оновлення даних -->
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Коментар</label>
                    <input type="text" name="content" id="content" class="form-control" value="{{ $comment->content }}">
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
    </div>
@endsection