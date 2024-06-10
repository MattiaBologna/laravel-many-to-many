<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
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
        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDAZIONE
        $request->validate([
            'title' => 'required|max:150',
            'link' => 'required|url'
        ]);


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

        // controlliamo se sono state inviate delle technologies
        if ($request->has('technologies')) {

            // attach()
            $new_project->technologies()->attach($request->technologies);
        }

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
        // eager loading (?)
        $project->load(['technologies']);

        $technologies = Technology::orderBy('name', 'asc')->get();

        return view('admin.projects.edit', compact('project', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        // VALIDAZIONE
        $request->validate([
            'title' => 'required|max:150',
            'link' => 'required|url'
        ]);

        $form_data = $request->all();

        $project->fill($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }

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
