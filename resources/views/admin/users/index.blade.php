@extends('layouts.sidebar')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Користувачі</h2>
            <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Створити користувача</a>
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
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Ім'я</th>
                    <th>Електронна пошта</th>
                    <th>Роль</th>
                    <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Редагувати</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені що хочете видалити цього користувача?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>

@endsection
