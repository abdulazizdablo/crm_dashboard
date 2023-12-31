@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">Edit task</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label class="required" for="title">Title</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                   name="title" id="title" value="{{ old('title', $task->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="description">Description</label>
                            <textarea class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}"
                                      rows="10" name="description"
                                      id="description">{{ old('description', $task->description) }}</textarea>
                            @if($errors->has('contact_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_email') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="date"
                                   name="deadline" id="deadline" value="{{ old('deadline', $task->deadline) }}">
                            @if($errors->has('deadline'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deadline') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Assigned user</label>
                            <select class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}"
                                    name="user_id" id="user_id" required>
                                @foreach($users as $id => $entry)
                                    <option
                                        value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $task->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group">
                            <label for="client_id">Assigned client</label>
                            <select class="form-control {{ $errors->has('client_id') ? 'is-invalid' : '' }}"
                                    name="client_id" id="client_id" required>
                                @foreach($clients as $id => $entry)
                                    <option
                                        value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $task->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('client_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client_id') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>


                        
                        <div class="form-group">
                            <label for="client_id">Assigned project</label>
                            <select class="form-control {{ $errors->has('project_id') ? 'is-invalid' : '' }}"
                                    name="project_id" id="project_id" required>
                                @foreach($projects as $id => $entry)
                                    <option
                                        value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $task->project_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('project_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('project_id') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>


                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                                    id="status" required>
                                @foreach(config('status') as $status)
                                    <option
                                        value="{{ $status }}" {{ (old('status') ? old('status') : $project->status ?? '') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Files</div>
                <div class="card-body">
                    <form action="" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="required" for="file">File</label>
                            <input class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" type="file"
                                   name="file" id="file">
                            @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            Upload
                        </button>
                    </form>

                    <table class="table mt-4">
                        <thead>
                        <tr>
                            <th scope="col">File name</th>
                            <th scope="col">Size</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($task->getMedia() as $media)
                            <tr>
                                <th scope="row">{{ $media->file_name }}</th>
                                <td>{{ $media->human_readable_size }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('media.download', $media) }}">
                                        Download
                                    </a>
                                    <form action="{{ route('media.delete', ['task', $task, $media]) }}"
                                          method="POST" onsubmit="return confirm('Are your sure?');"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection