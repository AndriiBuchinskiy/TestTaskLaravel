<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Report</title>
</head>
<body>
<h1>Report</h1>
<p>Users count: {{ $usersCount }}</p>
<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Tag</th>
        <th>Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($postsByTag as $post)
        <tr>
            <td>{{ $post->name }}</td>
            <td>{{ $post->tag }}</td>
            <td>{{ $post->count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Category</th>
        <th>Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($postsByCategory as $post)
        <tr>
            <td>{{ $post->name }}</td>
            <td>{{ $post->category }}</td>
            <td>{{ $post->count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Comments count: {{ $commentsCount }}</p>
<table>
    <thead>
    <tr>
        <th>User</th>
        <th>Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commentsByUser as $comment)
        <tr>
            <td>{{ $comment->name }}</td>
            <td>{{ $comment->count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
