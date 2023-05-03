@extends('layouts.sidebar')

@section('content')
    <h1>Create new role</h1>

    @if (count($permissions) > 0)
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="permissions[]">Permissions:</label>
                <br>
                @foreach ($permissions as $permission)
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ $permission->name }}<br>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Create role</button>
        </form>
    @else
        <p>No permissions found. Please create some permissions first.</p>
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('input.permission');
        checkAll.onclick = (e) => {
            if (e.target.checked) {
                checkboxes.forEach(el => el.checked = true);
            } else {
                checkboxes.forEach(el => el.checked = false);
            }
        }
    </script>
@endpush