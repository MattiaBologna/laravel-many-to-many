<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'asc')->get();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // recuperare i parametri dal form
        $form_data = $request->all();

        // creiamo l'istanza 
        $new_project = new Project();

        // SHORTCUT
        // $new_project = Project::create($form_data);

        // popoliamo l'istanza con i dati che arrivano dal form
        $new_project->title = $form_data['title'];
        $new_project->slug = Str::slug($new_project->title);
        $new_project->description = $form_data['description'];
        $new_project->type_id = $form_data['type_id'];
        $new_project->link = $form_data['link'];

        // salviamo l'istanza 
        $new_project->save();

        // return to_route('admin.projects.show', $new_project);
        return redirect()->route('admin.projects.show', $new_project);
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
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();

        $project->fill($form_data);

        $project->save();
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
