@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('projects.create') }}">
                Create project
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Projects list</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif


            <div class="d-flex justify-content-end">
                <form action="{{ route('projects.index') }}" method="GET">

                </form>
            </div>

            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Assigned to</th>
                        <th>Client</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></td>
                            <td>{{ $project->user->full_name }}</td>
                            <td>{{ $project->client->company_name }}</td>
                            <td>{{ $project->deadline }}</td>
                            <td>{{ $project->status }}</td>
                            <td>

                                @can('update',$project)
                                    <a class="btn btn-sm btn-info" href="{{ route('projects.edit', $project) }}">
                                        Edit
                                    </a>
                                @endcan
                                @can('delete')
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                        onsubmit="return confirm('Are your sure?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    </form>
                                @endcan



                                <form action="{{ route('projects.soft-delete', $project->id) }}" method="POST">

                                    @csrf
                                    <Input class="btn btn-sm btn-danger" type="submit" value="Soft Delete"
                                        placeholder="Soft Delete" {{$project->deleted_at ? "disabled  title = this project is softdeleted"  : ''}}>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $projects->withQueryString()->links() }}
        </div>
    </div>
@endsection
