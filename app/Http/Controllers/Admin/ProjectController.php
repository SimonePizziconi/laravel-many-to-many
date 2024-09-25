<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects =  Project::orderBy('id', 'desc')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        $new_project = Project::create($data);

        if (array_key_exists('technologies', $data)) {
            $new_project->technologies()->attach($data['technologies']);
        };

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();
        if ($data['title'] !== $project->title) {
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        }

        $project->update($data);

        if (array_key_exists('technologies', $data)) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', 'Il progetto ' . $project->title . ' è stato eliminato correttamente');
    }
}
