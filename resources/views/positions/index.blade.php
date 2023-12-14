<!DOCTYPE html>
<html>
<head>
    <title>User Positions</title>
</head>
<body>
<h1>User Positions</h1>

@if(isset($positions))
    <ul>
        @foreach($positions as $position)
            <li>{{ $position['id'] }}</li>
            <li>{{ $position['name'] }}</li>
        @endforeach
    </ul>
@else
    <p>No positions found.</p>
@endif
</body>
</html>
