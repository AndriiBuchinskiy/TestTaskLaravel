<!DOCTYPE html>
<html>
<head>
    <title>{{ $productWithUsers->title }}</title>
</head>
<body>
<h1>Information product</h1>
<p>ID: {{ $productWithUsers->id }}</p>
<p>Title: {{ $productWithUsers->title }}</p>
<p>Description: {{ $productWithUsers->description }}</p>
<p>Price: {{ $productWithUsers->price }}</p>

<h2>Users:</h2>
<ul>
    @foreach ($productWithUsers->users as $user)
        <li>
            ID: {{ $user->id }}<br>
            First Name: {{ $user->first_name }}<br>
            Last Name: {{ $user->last_name }}
        </li>
    @endforeach
</ul>
</body>
</html>