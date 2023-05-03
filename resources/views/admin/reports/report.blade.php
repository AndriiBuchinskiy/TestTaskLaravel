@extends('layouts.sidebar')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('generate-report') }}" class="btn btn-primary">Згенерувати звіт</a>
    </div>
@endsection