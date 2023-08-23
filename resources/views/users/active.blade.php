@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
      
    </div>

    <div class="card">
        <div class="card-header">Active Users list</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-responsive-sm table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                 
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($active_users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                      
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $active_users->withQueryString()->links() }}
        </div>
    </div>

@endsection