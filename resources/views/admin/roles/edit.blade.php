@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Role') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="permissions" class="col-md-4 col-form-label text-md-right">{{ __('Permissions') }}</label>

                                <div class="col-md-6">
                                    @foreach($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}" class="form-check-input" @if(in_array($permission->id, $checkedPermissions)) checked @endif>
                                            <label for="{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach

                                    @error('permissions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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