<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Jobs\ProcessEmail;
use App\Mail\ProjectAssigned;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $projects = Project::with('user:id,first_name,last_name', 'client:id,company_name')->withTrashed()->paginate(20);

        return view('layouts.projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
    

        return view('layouts.projects.create')->with('users', $users)->with('clients', $clients)->with('statuses', config('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {

        $project = Project::create(

            $request->validated()

        );

        $user = User::find($request->user_id);

        ProcessEmail::dispatch($user, $project);

        return back()->withMessage('Project has been created succefully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        $project->withCount('tasks');
        return view('layouts.projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {


        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');

        return view('layouts.projects.edit')->with('project', $project)->with('clients', $clients)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProjectRequest $request, Project $project)
    {

        $project->update($request->validated());
        return back()->withMessage('Project has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        $this->authorize('delete', User::class);

        $project->delete();
    }

    public function softDelete(Project $project)
    {

        $project->deleted_at = now();
        $project->save();

        return back()->withMessage('Project has been soft deleted successfully');
    }
}
