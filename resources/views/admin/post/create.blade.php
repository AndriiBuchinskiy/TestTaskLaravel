@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new post
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Title</label>
                    <input value="{{ old('title') }}"
                           type="text"
                           class="form-control shadow-none @error('title') is-invalid @enderror"
                           name="title"
                           placeholder="Title" required>
                </div>

                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Content</label>
                    <textarea type="text"
                              class="form-control shadow-none @error('content') is-invalid @enderror"
                              name="content"
                              placeholder="Content" required>
                         {{ old('content') }}
                    </textarea>
                </div>

                @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="category_id" class="form-label">Select category</label>
                    <select class="form-select shadow-none @error('category_id') is-invalid @enderror" name="category_id"
                            id="inputGroupSelect01">
                        <option selected>Select category</option>
                        @foreach($categories as $category)
                            <option
                                    value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-outline-primary shadow-none">Save product</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </form>
        </div>

    </div>
@endsection