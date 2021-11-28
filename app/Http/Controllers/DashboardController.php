<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Calendar;
use App\Models\Contact;
use App\Models\Goal;
use App\Models\GoalPlan;
use App\Models\Note;
use App\Models\Projects;
use App\Models\Setting;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {

        $settings_data = Setting::all();
        $settings = [];

        foreach($settings_data as $setting){
            $settings[$setting->key] = $setting->value;

        }

        $ldate = date('Y-m-d H:i:s');
        $today = Carbon::now();

        $todos= Todo::where('related_id', 0)
            ->orderBy('id', 'DESC')
            ->get();
        $recent_events = Calendar::orderBy('id', 'desc')
            ->limit(5)
            ->get();;





        $total_goals = Goal::count();
        $total_plans = GoalPlan::count();
        $total_notes = Note::count();
        $total_projects= Projects::count();
        $goals = Goal::orderBy('id', 'desc')
            ->limit(5)
            ->get();
        $recent_projects= Projects::orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return \view('dashboard',[
            'selected_navigation' => 'dashboard',
            'total_goals'=> $total_goals,
            'total_plans'=> $total_plans,
            'settings' => $settings,
            'total_notes'=>  $total_notes,
            'total_projects'=> $total_projects,
            'ldate'=>  $ldate,
            'today'=> $today,
            'goals'=> $goals,
            'recent_projects'=>$recent_projects,
            'todos'=> $todos,
            'recent_events'=> $recent_events


        ]);
    }
}
