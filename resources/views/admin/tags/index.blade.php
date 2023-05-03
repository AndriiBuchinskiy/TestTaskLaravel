@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Теги</h3>
            <div class="card-tools">
                <a href="{{ route('tags.create') }}" class="btn btn-primary">Створити тег</a>
            </div>
        </div>
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
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Назва</th>
                    <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-primary">Редагувати</a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені що хочете видалити цей тег?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Тегів не знайдено.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $tags->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection