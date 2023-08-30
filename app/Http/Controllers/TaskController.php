<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Carbon\Carbon;
use App\Enums\StatusModel;
use Illuminate\Auth\Access\Gate;
use App\Http\Requests\EditTaskRequest;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['user', 'client', 'project'])->withTrashed()->paginate(20);
        return view('layouts.tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        $projects = Project::all()->pluck('title', 'id');

        return view('layouts.tasks.create')->with('users', $users)->with('clients', $clients)->with('projects', $projects)->with('statuses', config('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $task = Task::create(
            $request->validated()
        );


        $user = User::find($request->user_id);

        $user->notify(new TaskAssigned($task));
        return redirect()->route('tasks.index')->withMessage('Task has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('layouts.tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        $projects = Project::all()->pluck('title', 'id');


        return view('layouts.tasks.edit')->with('task', $task)->with('users', $users)->with('clients', $clients)->with('projects', $projects);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return back()->withMessage('Task has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        Gate::authorize('delete-task');

        $task->delete();
    }

    public function softDelete(Task $task)
    {

        $task->deleted_at = now();
        $task->save();
        return redirect()->route('tasks.index')->with('message', 'Task has been soft deleted successfully');
    }
}
