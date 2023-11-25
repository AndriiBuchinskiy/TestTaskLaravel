<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
<h1>Create User</h1>
<a href="{{ route('users.index') }}">Users</a>
<form action="{{ route('users.store') }}" method="post">
    @csrf

    <label for="first_name">Title:</label>
    <input type="text" name="first_name" required>
    @error('first_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="last_name">Last name:</label>
    <textarea name="last_name"></textarea>
    @error('last_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>


    <label for="products_id">Products:</label>
    <select name="products_id[]" multiple>

        @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->title }}</option>
        @endforeach
    </select>
    @error('product_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <label for="avatar">Avatar:</label>
    <input type="file" name="avatar">
    @error('avatar')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <button type="submit">Create User</button>
</form>
</body>
</html>