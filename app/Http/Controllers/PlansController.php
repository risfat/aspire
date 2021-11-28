<?php

namespace App\Http\Controllers;

use App\Models\BusinessPlan;
use App\Models\Calendar;
use App\Models\Goal;
use App\Models\GoalPlan;
use App\Models\ToLearn;
use App\Models\WeeklyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlansController extends BaseController
{
    //
    public function plans()
    {
        $plans= GoalPlan::all();
        $goals = Goal::all()
            ->keyBy('id')
            ->all();

        return \view('plans.plans',[

            'selected_navigation' => 'plans',
            'plans'=> $plans,
            'goals'=> $goals
        ]);
    }

    public function planView(Request $request)
    {  $plan = false;

        if($request->id)
        {
            $plan = GoalPlan::find($request->id);
        }
        $goals = Goal::all()
            ->keyBy('id')
            ->all();

        return \view('plans.view-plan',[

            'selected_navigation' => 'plans',
            'plan'=> $plan,
            'goals'=> $goals,

        ]);
    }
    public function weeklyPlans()
    {    $plans= WeeklyPlan::all();

        return \view('plans.weekly-planner',[

            'selected_navigation' => 'weekly-plans',
            'plans'=>  $plans
        ]);
    }
    public function weeklyPlan(Request $request)
    {

        $plan = false;

        if($request->id)
        {
            $plan = WeeklyPlan::find($request->id);
        }

        return \view('plans.weekly-plan',[

            'selected_navigation' => 'weekly-plan',
            'plan'=> $plan,
        ]);
    }

    public function weeklyPlanPost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $plan = false;

        if($request->id){

            $plan = WeeklyPlan::find($request->id);
        }

        if(!$plan){

            $plan = new WeeklyPlan();
            $plan->uuid = Str::uuid();
        }

        $plan->title = $request->title;

        $plan->from_date = $request->from_date;
        $plan->to_date = $request->to_date;
        $plan->saturday = clean($request->saturday);
        $plan->sunday = clean($request->sunday);
        $plan->monday = clean($request->monday);
        $plan->tuesday = clean($request->tuesday);
        $plan->wednesday = clean($request->wednesday);
        $plan->thursday = clean($request->thursday);
        $plan->friday = clean($request->friday);
        $plan->notes = clean($request->notes);
        $plan->save();

        return redirect('/weekly-plans');


    }



    public function goalPlans(Request $request)
    {
        $goals= Goal::all();

        $plan = false;

        if($request->id)
        {
            $plan = GoalPlan::find($request->id);
        }

        return \view('plans.goal-plan',[

            'selected_navigation' => 'plans',
            'plan'=> $plan,
            'goals'=> $goals
        ]);
    }

    public function goalPlanPost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $plan = false;

        if($request->id){

            $plan = GoalPlan::find($request->id);
        }



        if(!$plan){

            $plan = new GoalPlan();
            $plan->uuid = Str::uuid();
        }

        $plan->title = $request->title;
        $plan->goal_id = $request->goal_id;
        $plan->date = $request->date;
        $plan->description = clean($request->description);


        $plan->save();

        return redirect('/plans');


    }


    public function calendarAction(Request $request,$action = '')
    {
        switch ($action)
        {
            case '':
                $events = Calendar::all();

                return \view('plans.calendar',[

                    'selected_navigation' => 'calendar',
                    'events'=> $events
                ]);
                break;

            case 'event':

                $request->validate([
                    'id' => 'nullable|integer',
                ]);

                $event = false;

                if($request->id)
                {
                    $event = Calendar::find($request->id);
                }

                if($event)
                {
                    $date = $event->start_date;
                }
                else{
                    $date = $request->date ?? date('Y-m-d');
                }

                return \view('plans.event',[

                    'selected_navigation' => 'calendar',
                    'event' => $event,
                    'date' => $date,
                ]);
                break;

        }

    }


    public function eventPost(Request $request)
    {
        $request->validate([

            'title'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $event = false;

        if($request->id){

            $event = Calendar::find($request->id);
        }

        if(!$event){

            $event = new Calendar();
            $event->uuid = Str::uuid();
        }

        $event->title = $request->title;

        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->save();

        return redirect('/calendar');


    }

    public function businessPlans()

    {
        $plans= BusinessPlan::all()
            ->keyBy('id')
            ->all();




        return \view('plans.business-plans',[

            'selected_navigation' => 'business-plan',
            'plans'=> $plans,

        ]);
    }
    public function writeBusinessPlans(Request $request)
    {
        $plan = false;

        if($request->id)
        {
            $plan = BusinessPlan::find($request->id);
        }

        return \view('plans.write-business-plan',[

            'selected_navigation' => 'business-plan',
            'plan'=> $plan,
        ]);
    }

    public function viewBusinessPlan(Request $request)
    {
        $plan = false;

        if($request->id)
        {
            $plan = BusinessPlan::find($request->id);
        }

        return \view('plans.view-business-plan',[

            'selected_navigation' => 'business-plan',
            'plan'=> $plan
        ]);
    }

    public function businessPlanPost(Request $request)
    {
        $request->validate([

            'name'=>'required|max:150',
            'id'=>'nullable|integer',

        ]);

        $plan = false;

        if($request->id){

            $plan = BusinessPlan::find($request->id);
        }

        if(!$plan){

            $plan = new BusinessPlan();
            $plan->uuid = Str::uuid();
        }

        $plan->name = $request->name;

        $plan->date = $request->date;
        $plan->email = $request->email;
        $plan->phone = $request->phone;
        $plan->website = $request->website;
        $plan->company_name = $request->company_name;
        $plan->ex_summary = clean($request->ex_summary);
        $plan->description = clean($request->description);
        $plan->m_analysis = clean($request->m_analysis);
        $plan->management = clean($request->management);
        $plan->product = clean($request->product);
        $plan->marketing = clean($request->marketing);
        $plan->budget = $request->budget;
        $plan->investment = clean($request->investment);
        $plan->finance = clean($request->finance);
        $plan->appendix = clean($request->appendix);
        $plan->save();

        return redirect('/business-plans');


    }



}
