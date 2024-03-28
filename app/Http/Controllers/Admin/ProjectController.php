<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller


{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('updated_at')->orderByDesc('created_at')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::select('label', 'id')->get();
        $technologies = Technology::select('label', 'id')->get();
        return view('admin.projects.create', compact('project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        /*$request->validate([

            'title' => 'required|string|min:5|max:40|unique:projects',
            'content' => 'required|string',
            'image' => 'required|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ], [
            'title.required' => 'il titolo è obbligatorio',
            'title.min' => 'il titolo deve contenere almeno 5 caratteri',
            'title.max' => 'il titolo non può superare i 40 caratteri',
            'title.unique' => 'non possono esistere due progetti con lo stesso titolo',
            'image.image' => 'il file inserito non è un\'immagine',
            'content.required' => 'il contenuto è obbligatorio',
            'type_id.exists' => 'Tipo di progetto non valido ',
            'technologies.exists' => 'Tecnologie selezionate non valide'

        ]);*/

        $data = $request->all();
        $newProject = new Project();
        if (Arr::exists($data, 'image')) {
            $img_url = Storage::putFile('project_images', $data['image']);
            $newProject->image = $img_url;
        }
        $newProject->fill($data);
        $newProject->save();
        if (Arr::exists($data, 'tech_ids')) {
            $newProject->technologies()->attach($data['tech_ids']);
        }
        return to_route('admin.projects.index', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.show', compact('project', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('label', 'id')->get();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([

            'title' => 'required|string|min:5|max:40|unique:projects',
            'content' => 'required|string',
            'image' => 'required|image',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ], [
            'title.required' => 'il titolo è obbligatorio',
            'title.min' => 'il titolo deve contenere almeno 5 caratteri',
            'title.max' => 'il titolo non può superare i 40 caratteri',
            'title.unique' => 'non possono esistere due progetti con lo stesso titolo',
            'image.image' => 'il file inserito non è un\'immagine',
            'content.required' => 'il contenuto è obbligatorio',
            'type_id.exists' => 'Tipo di progetto non valido',
            'technologies.exists' => 'Tecnologie selezionate non valide'

        ]);

        $data = $request->all();
        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::putFile('project_images', $data['image']);
            $project->image = $img_url;
        }
        $project->update($data);
        $types = Type::select('label', 'id')->get();
        return to_route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)

    {
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return to_route('admin.projects.index');
    }
}
