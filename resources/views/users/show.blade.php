<!DOCTYPE html>
<html>
<head>
    <title>{{ $userWithProducts->first_name }} {{ $userWithProducts->last_name }}</title>
</head>
<body>
<h1>{{ $userWithProducts->first_name }} {{ $userWithProducts->last_name }}</h1>
<p>ID: {{ $userWithProducts->id }}</p>
<p>Amount: {{ $userWithProducts->amount }}</p>
<p>Avatar: {{ $userWithProducts->avatar }}</p>

<h2>Products:</h2>
<ul>
    @foreach ($userWithProducts->products as $product)
        <li>
            ID: {{ $product->id }}<br>
            Title: {{ $product->title }}<br>
            Description: {{ $product->description }}<br>
            Price: {{ $product->price }}
        </li>
    @endforeach
</ul>
</body>
</html>

