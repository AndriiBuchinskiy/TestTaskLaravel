<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<h1>Edit User</h1>
<a href="{{ route('users.index') }}">Users</a>
<form action="{{ route('users.update', ['user' => $userWithProducts->id]) }}" method="post">
    @csrf
    @method('PUT')

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="{{ old('first_name', $userWithProducts->first_name) }}" required>
    @error('first_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="{{ old('last_name', $userWithProducts->last_name) }}" required>
    @error('last_name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="product_id">Products:</label>
    <select name="product_id[]" multiple>
        @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ in_array($product->id, $selectedProductIds) ? 'selected' : '' }}>
                {{ $product->title }}
            </option>
        @endforeach
    </select>
    @error('product_id')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit">Update User</button>
</form>

</body>
</html>
