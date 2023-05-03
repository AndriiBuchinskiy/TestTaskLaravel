@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Пости</h1>
                <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Створити пост</a>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @php
                        Session::forget('success');
                    @endphp
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($posts->count())
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Назва</th>
                            <th>Автор</th>
                            <th>Створено</th>
                            <th>Відредаговано</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user ? $post->user->name : 'Видалений' }}</td>
                                <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $post->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Редагувати</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені що хочете видалити цей пост?')">Видалити</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No posts yet!</p>
                @endif
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection
