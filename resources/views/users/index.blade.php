<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Users</h1>
<a href="{{ route('users.create') }}">Create User</a>
@if(request()->expectsJson())
    <ul>
        @foreach ($userResourceCollection as $user)
            <li>{{ $user->id }} - {{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
    {{ $userResourceCollection->links() }}
@else
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Registration Timestamp</th>
            <th>Photo</th>
        </tr>

        </thead>
        <tbody>
        @foreach ($userResourceCollection as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->position }}</td>
                <td>{{ $user->registration_timestamp }}</td>
                <td><img src="{{ $user->photo }}" alt=" Photo" width="50"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $userResourceCollection->links() }}
@endif
</body>
</html>
