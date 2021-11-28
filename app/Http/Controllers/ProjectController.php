<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Projects;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends BaseController
{
    //
    public function projects()
    {   $projects= Projects::all();

        return \view('projects.projects',[

            'selected_navigation' => 'projects',
            'projects'=> $projects
        ]);
    }
    public function createProject(Request $request)
    {
        $project = false;

        if($request->id)
        {
            $project = Projects::find($request->id);
        }

        return \view('projects.create-project',[

            'selected_navigation' => 'projects',
            'project'=> $project
        ]);
    }

    public function projectView(Request $request)
    {
        $project = false;

        if($request->id)
        {
            $project = Projects::find($request->id);
        }
        $todos_projects = Todo::where('related_to', 'project')
            ->where('related_id', $project->id)

            ->orderBy('id', 'DESC')
            ->get();

        return \view('projects.view-project',[

            'selected_navigation' => 'projects',
            'project'=> $project,
            'todos_projects'=> $todos_projects
        ]);
    }



    public function projectPost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $project = false;

        if($request->id){

            $project = Projects::find($request->id);
        }

        if(!$project ){

            $project  = new Projects();
            $project ->uuid = Str::uuid();
        }

        $project ->title = $request->title;

        $project ->start_date = $request->start_date;
        $project ->end_date = $request->end_date;
        $project ->summary = $request->summary;
        $project ->status = $request->status;
        $project ->description = $request->description;
        $project ->save();

        return redirect('/projects');


    }
}
