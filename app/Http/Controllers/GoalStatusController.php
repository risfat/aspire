<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalStatusController extends Controller
{
    //

    public function store($action, Request $request)
    {
        switch ($action)
        {
            case 'change-status':

                $request->validate([
                    'id' => 'required|integer',
                    'status' => 'required|string',
                ]);

                $goal = Goal::find($request->id);



                if( $goal)
                {
                    if($request->status === 'Completed')
                    {
                        $goal->completed = 1;
                    }
                    else{
                        $goal->completed = 0;
                    }

                    $goal->save();
                }

                break;
        }

    }
}
