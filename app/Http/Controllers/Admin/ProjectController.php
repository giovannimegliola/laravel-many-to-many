<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $formData = $request->validated();
        //create slug
        $slug = Project::getSlug($formData['title']);
        //add slug to formData
        $formData['slug']= $slug;
        //prendiamo l'id dell'utente loggato
        $userId = auth()->id();
        //aggiungiamo l'id dell'utente
        $formData['user_id'] = $userId;



        if ($request->hasFile('image')) {
            $path = Storage::put('images', $request->image);
            $formData['image'] = $path;
        }

        $project = Project::create($formData);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $formData = $request->validated();
        $formData['slug']= $project->slug;

        if ($project->title !== $formData['title']) {
            //CREATE SLUG
            $slug = Project::getSlug($formData['title']);
            $formData['slug'] = $slug;
        }


        //aggiungiamo l'id dell'utente proprietario del post
        $formData['user_id'] = $project->user_id;

        if ($request->hasFile('image')) {
            if ($project->image){
                Storage::delete($project->image);
            }

            $path = Storage::put('images', $request->image);
            $formData['image'] = $path;
        }

        $project->update($formData);
        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->image){
            Storage::delete($project->image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', "Il progetto $project->title è stato eliminato");
    }
}
