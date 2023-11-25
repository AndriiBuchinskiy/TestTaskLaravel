<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
<h1>Create Product</h1>
<a href="{{ route('products.index') }}">Products</a>
<form action="{{ route('products.store') }}" method="post">
    @csrf

    <label for="title">Title:</label>
    <input type="text" name="title" required>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="price">Price:</label>
    <input type="number" name="price" required>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="users_id">Users:</label>
    <select name="users_id[]" multiple>

        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
        @endforeach
    </select>
    @error('users_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <button type="submit">Create Product</button>
</form>
</body>
</html>
