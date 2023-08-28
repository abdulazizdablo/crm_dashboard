<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Client;

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
        //$projectstatus = StatusModel::cases();


        /* $flatArray = [];
        foreach ($projectstatus as $case) {
            $flatArray[$case->name] = $case->value;
        }*/



        return view('layouts.projects.create')->with('users', $users)->with('clients', $clients)->with('statuses', config('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {


        ////$client = Client::find($request->client_id);
        //$client->projects()->create($request->all());
        // $user  = User::find($request->user_id);



        //$project = new Project();
        //$project->fill($request->all());


        // $project->save();





        /*auth()->user()->projects()->create( array_merge($request->validated(),
['deadline' => Carbon::parse($request->deadline)]));*/


        // dd($request->user_id);
        Project::create(
        

            $request->validated()

        );

        return redirect()->route('projects.index')->with(['message' => 'Project has been created succefully']);
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

       // $this->authorize('update',$project);
        return view('layouts.projects.edit')->with('project',$project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProjectRequest $request, Project $project)
    {

        //$this->authorize('update',  $project);


        $project->update($request->validated());
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

        //  $project->update(['deleted_at'=> Carbon::now()]);

        $project->deleted_at = now();
        $project->save();

        return redirect()->route('projects.index')->with('message', 'Project has been soft deleted successfully');
    }
}
