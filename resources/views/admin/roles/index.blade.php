@extends('layouts.sidebar')

@section('content')
    <h1>Ролі користувачів</h1>
    <p><a href="{{ route('roles.create') }}">Створити нову роль</a></p>

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
            <th>Назва</th>
            <th>Дозволи</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <ul>
                        @foreach ($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Редагувати</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені що хочете видалити цю роль?')" >Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection