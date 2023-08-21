<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all()->paginate(20);
        return redirect()->route('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
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
