@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Додати новий пост
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Назва</label>
                    <input value="{{ old('title') }}"
                           type="text"
                           class="form-control shadow-none @error('title') is-invalid @enderror"
                           name="title"
                           placeholder="Title" required>
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Контент</label>
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
                    <label for="category_id" class="form-label">Виберіть категорію</label>
                    <select class="form-select shadow-none @error('category_id') is-invalid @enderror" name="category_id"
                            id="inputGroupSelect01">
                        <option selected>Виберіть категорію</option>
                        @foreach($categories as $category)
                            <option
                                    value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Виберіть теги</label>
                    <select class="form-select shadow-none @error('tags') is-invalid @enderror" name="tags[]"
                            id="inputGroupSelect01" multiple>
                        @foreach($tags as $tag)
                            <option
                                    value="{{ $tag->id }}" {{ in_array($tag->id, old('tags') ?: []) ? 'selected' : ''}}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="img_path" class="form-label">Зображення</label>
                <div class="mb-3 input-group">
                    <input type="file"
                           class="form-control shadow-none @error('img_path') is-invalid @enderror"
                           name="img_path"
                           placeholder="Image" required>
                </div>

                @error('img_path')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('$tags')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-outline-primary shadow-none">Зберегти пост</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary shadow-none">Назад</a>
            </form>
        </div>

    </div>
@endsection