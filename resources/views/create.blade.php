<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">My Blog</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
        </li>
    </ul>
</nav>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
