<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function list()
    {
        return view('projects.list', [
            'projects' => Project::all()
        ]);
    }

    public function delete(Project $project)
    {
        $project->delete();
        
        return redirect('/console/projects/list')
            ->with('message', 'Project has been deleted!');        
    }

    public function addForm()
    {
        return view('projects.add');
    }
    public function add()
    {

        $attributes = request()->validate([
            'title' => 'required',
            'slug' => 'required|unique:projects|regex:/^[A-z\-]+$/',
            'url' => 'nullable',
            'github' =>'nullable',
            'date' => 'nullable',
            'content' => 'required',
        ]);

        $project = new Project();
        $project->title = $attributes['title'];
        $project->slug = $attributes['slug'];
        $project->url = $attributes['url'];
        $project->content = $attributes['content'];
        $project->github = $attributes['github'];
        $project->date =$attributes['date'];
        $project->user_id = Auth::user()->id;
        $project->save();

        return redirect('/console/projects/list')
            ->with('message', 'Project has been added!');
    }

    public function editForm(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function edit(Project $project)
    {

        $attributes = request()->validate([
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('projects')->ignore($project->id),
                'regex:/^[A-z\-]+$/',
            ],
            'url' => 'nullable',
            'github' =>'nullable',
            'date'=>'nullable',
            'content' => 'required',
        ]);

        $project->title = $attributes['title'];
        $project->slug = $attributes['slug'];
        $project->url = $attributes['url'];
        $project->github = $attributes['github'];
        $project->date = $attributes['date'];
        $project->content = $attributes['content'];
        $project->save();

        return redirect('/console/projects/list')
            ->with('message', 'Project has been edited!');
    }

    public function imageForm(Project $project)
    {
        return view('projects.image', [
            'project' => $project,
        ]);
    }

    public function image(Project $project)
    {

        $attributes = request()->validate([
            'image' => 'required|image',
        ]);

        Storage::delete($project->image);
        
        $path = request()->file('image')->store('projects');

        $project->image = $path;
        $project->save();
        
        return redirect('/console/projects/list')
            ->with('message', 'Project image has been edited!');
    }
}
