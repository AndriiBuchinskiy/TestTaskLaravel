@extends('layouts.sidebar')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Tag</h3>
        </div>
        <form action="{{ route('tags.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer clearfix">
                <button type="submit" class="btn btn-primary float-right">Create</button>
            </div>
        </form>
    </div>
@endsection