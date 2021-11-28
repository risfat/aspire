<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Note;
use App\Models\Projects;
use App\Models\Todo;
use App\Models\ToLearn;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActionsController extends BaseController
{
    //
    public function notes()
    {   $notes = Note::all();

        return \view('actions.notes',[

            'selected_navigation' => 'notes',
            'notes'=> $notes
        ]);
    }

    public function todos()
    {

        $project_todos = Todo::where('related_to', 'project')
            ->count();
        $goal_todos = Todo::where('related_to', 'goal')
            ->count();
        $todays_todos = Todo::where('related_id', 0)
            ->count();
        $todos= Todo::where('related_id', 0)
            ->orderBy('id', 'DESC')
            ->get();




        return \view('actions.todos',[

            'selected_navigation' => 'todos',
            'todos'=> $todos,
            'project_todos'=> $project_todos,
            'goal_todos'=> $goal_todos,
            'todays_todos'=> $todays_todos
        ]);
    }

    public function addTask(Request $request)
    {

        $for = $request->for;

        $todo = false;

        if($request->id)
        {
            $todo = Todo::find($request->id);
            if($todo)
            {
                if($todo->related_to === 'project'){
                    $for = 'project';
                }

                if($todo->related_to === 'goal'){
                    $for = 'goal';
                }

            }
        }



        $projects = [];
        $goals = [];

        if($for === 'project')
        {
            $projects = Projects::all();
        }
        elseif ($for === 'goal')
        {
            $goals = Goal::all();
        }


        $todos_projects = Todo::where('related_to', 'project')
            ->orderBy('id', 'DESC')
            ->get();
        $todos_goals = Todo::where('related_to', 'goal')
            ->orderBy('id', 'DESC')
            ->get();
        $todos= Todo::where('related_id', 0)
            ->orderBy('id', 'DESC')
            ->get();

        return \view('actions.add-task',[

            'selected_navigation' => 'todos',
            'todo'=> $todo,
            'todos'=> $todos,
            'for' => $for,
            'projects' => $projects,
            'goals' => $goals,
            'todos_projects'=> $todos_projects,
            'todos_goals'=>$todos_goals

        ]);
    }

    public function todoPost(Request $request)
    {

        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',
            'project_id' => 'nullable|integer',
            'goal_id' => 'nullable|integer',

        ]);

        $todo = false;

        if($request->id){

            $todo  = Todo::find($request->id);
        }

        if(! $todo ){

            $todo  = new Todo();

        }

        $todo->title = $request->title;
        $todo->date = $request->date;
        $todo->description= clean($request->description);

        if($request->project_id)
        {
            $todo->related_to = 'project';
            $todo->related_id = $request->project_id;
        }
        elseif ($request->goal_id)
        {
            $todo->related_to = 'goal';
            $todo->related_id = $request->goal_id;
        }

        $todo->save();


        if($request->project_id)
        {
            return redirect('/add-task?for=project');
        }
        elseif ($request->goal_id)
        {
            return redirect('/add-task?for=goal');
        }


        return redirect('/add-task');


    }



    public function tolearn()
    {
       $to_learns = ToLearn::all();


        return \view('actions.tolearn',[

            'selected_navigation' => 'tolearn',
            'to_learns'=> $to_learns

        ]);
    }


    public function addtoLearn(Request $request)
    {   $to_learn = false;

        if($request->id)
        {
            $to_learn = ToLearn::find($request->id);
        }

        return \view('actions.add-tolearn',[

            'selected_navigation' => 'tolearn',
            'to_learn'=> $to_learn,
        ]);
    }
    public function toLearnPost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $to_learn = false;

        if($request->id){

            $to_learn = ToLearn::find($request->id);
        }

        if(!$to_learn){

            $to_learn = new ToLearn();
            $to_learn->uuid = Str::uuid();
        }

        $to_learn->title = $request->title;

        $to_learn->start_date = $request->start_date;
        $to_learn->end_date = $request->end_date;
        $to_learn->description = clean($request->description);
        $to_learn->save();

        return redirect('/tolearn');


    }





    public function addNote(Request $request)
    {  $note = false;

        if($request->id)
        {
            $note = Note::find($request->id);
        }



        return \view('actions.add-note',[

            'selected_navigation' => 'notes',
            'note'=> $note
        ]);
    }


    public function viewNote(Request $request)
    {  $note = false;

        if($request->id)
        {
            $note = Note::find($request->id);
        }


        return \view('actions.view-note',[

            'selected_navigation' => 'notes',
            'note'=> $note
        ]);
    }
    public function viewTodo(Request $request)
    {  $todo = false;

        if($request->id)
        {
            $todo = Todo::find($request->id);
        }


        return \view('actions.view-todo',[

            'selected_navigation' => 'todos',
            'todo'=> $todo,
        ]);
    }
    public function notePost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

      $note = false;

        if($request->id){

            $note = Note::find($request->id);
        }

        if(!$note){

            $note = new Note();
            $note->uuid = Str::uuid();
        }

        $note->title = $request->title;
        $note->topic = $request->topic;


        $note->notes = $request->notes;
        $note->save();

        return redirect('/notes');


    }

}
