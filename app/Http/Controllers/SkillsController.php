<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SkillsController extends Controller
{
  public function list()
  {
      return view('skills.list', [
          'skills' => Skill::all()
      ]);
  }
  public function delete(Skill $skill)
  {
      $skill->delete();
      
      return redirect('/console/skills/list')
          ->with('message', 'Skill has been deleted!');        
  }
  public function addForm()
    {
        return view('skills.add');
    }
    public function add()
    {

        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $skill = new Skill();
        $skill->name = $attributes['name'];
        $skill->user_id = Auth::user()->id;
        $skill->save();

        return redirect('/console/skills/list')
            ->with('message', 'Skill has been added!');
    }
    public function editForm(Skill $skill)
    {
        return view('skills.edit', [
            'skill' => $skill
        ]);
    }

    public function edit(Skill $skill)
    {

        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $skill->name = $attributes['name'];
        $skill->save();

        return redirect('/console/skills/list')
            ->with('message', 'Skill has been edited!');
    }
    public function imageForm(Skill $skill)
    {
        return view('skills.image', [
            'skill' => $skill,
        ]);
    }

    public function image(Skill $skill)
    {

        $attributes = request()->validate([
            'image' => 'required|image',
        ]);
        
        if ($skill->image){
          Storage::delete($skill->image);
        }
        
        $path = request()->file('image')->store('skills');

        $skill->image = $path;
        $skill->save();
        
        return redirect('/console/skills/list')
            ->with('message', 'Skill image has been edited!');
    }
}
