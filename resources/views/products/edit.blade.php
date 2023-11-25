<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - {{ $productWithUsers->title }}</title>
</head>
<body>
<h1>Edit Product - {{ $productWithUsers->title }}</h1>
<a href="{{ route('products.index') }}">Products</a>
<form action="{{ route('products.update', ['product' => $productWithUsers->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title:</label>
    <input type="text" name="title" value="{{ $productWithUsers->title }}" required>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="description">Description:</label>
    <textarea name="description">{{ $productWithUsers->description }}</textarea>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="price">Price:</label>
    <input type="text" name="price" value="{{ $productWithUsers->price }}" required>
    @error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="users_id">Users:</label>
    <select name="users_id[]" multiple>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ in_array($user->id, $selectedUserIds) ? 'selected' : '' }}>
                {{ $user->first_name }} {{ $user->last_name }}
            </option>
        @endforeach
    </select>
    @error('users_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <button type="submit">Update Product</button>
</form>
</body>
</html>
