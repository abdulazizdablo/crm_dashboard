<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Enums\StatusModelEnum;
use Illuminate\Support\Arr;

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
        //$projectstatus = StatusModel::cases();


       /* $flatArray = [];
        foreach ($projectstatus as $case) {
            $flatArray[$case->name] = $case->value;
        }*/

        

        return view('layouts.projects.create')->
        with('users', $users)->
        with('clients', $clients)->
        with('statuses',config('status'));
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
        return view('layouts.projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('layouts.projects.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProjectRequest $request, Project $project)
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
