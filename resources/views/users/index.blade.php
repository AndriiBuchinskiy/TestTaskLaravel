<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('users.create') }}">Create new user</a>
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
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>First Name Last Name</th>
        <th>Products</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>
                <a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
            </td>
            <td>
                <ul>
                    @foreach ($user->products as $product)
                        <li>{{ $product->id }} - {{ $product->title }} - {{ $product->description }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                <form action="{{ route('users.edit', ['user' => $user->id]) }}" method="get">
                    @csrf
                    <button type="submit">Edit</button>
                </form>
                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
