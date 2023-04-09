@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Edit role
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name', $role->name) }}"
                           type="text"
                           class="form-control shadow-none @error('name') is-invalid @enderror"
                           name="name"
                           placeholder="Name" required>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <table class="table table-striped">
                    <thead>
                    <th scope="col" width="1%"><input type="checkbox" name="all_permission" id="checkAll"></th>
                    <th scope="col" width="20%">Name</th>
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="permissions[{{ $permission->id }}]"
                                       value="{{ $permission->id }}"
                                       class="permission"
                                        {{ (in_array($permission->id, $checkedPermissions) ? 'checked' : '')}}>
                            </td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach

                </table>

                <button type="submit" class="btn btn-primary mb-3">Update role</button>
                <a href="{{ route('roles.index') }}" class="btn btn-primary mb-3">Back</a>
            </form>
        </div>

    </div>
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