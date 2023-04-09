@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="lead">
            All roles
        </div>

        <div class="container mt-4">

            <table class="table table-striped">
                <thead>
                <th scope="col" width="80%">Name</th>
                <th scope="col" width="10%"></th>
                <th scope="col" width="1%">
                    @can('create', Role::class)
                        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">

                        </a>
                    @endcan
                </th>
                </thead>

                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('update', $role)
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary mb-3">
                                </a>
                            @endcan
                        </td>
                        <td>
                            @can('delete', $role)
                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary mb-3">
                                       Delete
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection