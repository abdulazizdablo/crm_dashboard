<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('users', 'clients')->paginate(20);
       
        return view('layouts.projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::all()->pluck('full_name', 'id');
        $clients = Client::all()->pluck('company_name', 'id');
        return view('layouts.projects.create')->with('users',$users)->with('clients',$clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {



        Project::create(

            array_merge($request->validated()),
            ['deadline' => Carbon::parse($request->deadline)]
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('project.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('project.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }

    public function sofDelete(Project $project)
    {

        $project->deleted_at = now();
        $project->save();
    }
}
