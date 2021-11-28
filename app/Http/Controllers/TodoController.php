<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store($action, Request $request)
    {
        switch ($action)
        {
            case 'change-status':

                $request->validate([
                    'id' => 'required|integer',
                    'status' => 'required|string',
                ]);

                $todo = Todo::find($request->id);



                if($todo)
                {
                    if($request->status === 'Completed')
                    {
                        $todo->completed = 1;
                    }
                    else{
                        $todo->completed = 0;
                    }

                    $todo->save();
                }

                break;
        }
    }
}
