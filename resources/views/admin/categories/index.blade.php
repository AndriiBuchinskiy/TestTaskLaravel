@extends('layouts.sidebar')

@section('content')
    <h1>Категорії</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Створити категорію</a>
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


    <table class="table">
        <thead>
        <tr>
            <th>Назва категорії</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Редагувати</a>

                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені що хочете видалити цю категорію?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categories->links('pagination::bootstrap-4') }}

@endsection