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

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks =Task::with(['user','client','project'])->paginate(20);
        return view('layouts.tasks.index')->with('tasks',$tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        $projects = Project::all()->pluck('title','id');
        //$taskstatus = StatusModel::cases();

        /*$flatArray = [];
        foreach ($taskstatus as $case) {
            $flatArray[$case->name] = $case->value;
        }*/
        return view('layouts.tasks.create')->
        with('users',$users)->
        with('clients',$clients)->
        with('projects',$projects)->
        with('statuses',config('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        Task::create(array_merge($request->validated(),
        ['deadline'=> Carbon::parse('deadline')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function sofDelete(Task $task)
    {

        $task->delete_at = now();
        $task->save();
    }
}
