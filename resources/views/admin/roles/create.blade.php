@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Add new role and assign permissions
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}"
                           type="text"
                           class="form-control shadow-none"
                           name="name"
                           placeholder="Name" required>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="permissions" class="form-label">Assign Permissions</label>

                <table class="table table-striped">
                    <thead>
                    <th scope="col" width="1%"><input type="checkbox" id="checkAll" name="all_permissions"></th>
                    <th scope="col" width="20%">Name</th>
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       name="permissions[{{ $permission->id}}]"
                                       value="{{ $permission->id }}"
                                       class='permission'>
                            </td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach

                </table>

                <button type="submit" class="btn btn-primary">Save role</button>
                <button type="button" href="{{ route('roles.index') }}" class="btn btn-outline-secondary shadow-none">Back</button>
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