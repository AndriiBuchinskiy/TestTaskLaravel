<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('products.create') }}">Create Product</a>
    <a href="{{ route('users.index') }}">Users</a>
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

        .actions {
            width: 100px;
        }

        .actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<h1>Products</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Descriptions</th>
        <th>Price</th>
        <th>Users</th>
        <th class="actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>
                <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
            </td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <ul>
                    @foreach ($product->users as $user)
                        <li>{{$user->id}} - {{ $user->first_name }} {{ $user->last_name }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="actions">
                <button onclick="window.location.href='{{ route('products.edit', ['product' => $product->id]) }}'">Edit</button>
                <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
