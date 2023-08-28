@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Users') }}
        </div>

        <div class="alert alert-info" role="alert">Sample table page</div>

        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->getFullNameAttribute() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('users.soft-delete', $user->id) }}" method="POST">

                                    @csrf
                                    <Input class="btn btn-sm btn-danger" type="submit" value="Soft Delete"
                                        placeholder="Soft Delete">
                                  
                                </form>
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
@endsection
