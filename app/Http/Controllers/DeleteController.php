<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\BusinessPlan;
use App\Models\Calendar;

use App\Models\Document;

use App\Models\FiveMinuteJournal;
use App\Models\Goal;
use App\Models\GoalPlan;
use App\Models\Image;
use App\Models\LeadCaptureForm;
use App\Models\Note;
use App\Models\Projects;

use App\Models\Todo;
use App\Models\ToLearn;
use App\Models\User;
use App\Models\WeeklyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends BaseController
{
    //
    public function delete($action,$id)
    {
        switch ($action){
            case 'contact':

                $contact = Contact::find($id);
                if ($contact){

                    $contact->delete();
                    return redirect('/people');
                }

                break;





            case 'today-todo':

                $todo = Todo::find($id);

                if ($todo){

                    $redirect_url = '/add-task';

                    if($todo->related_to === 'project')
                    {
                        $redirect_url = 'add-task?for=project';
                    }

                    if($todo->related_to === 'goal')
                    {
                        $redirect_url = 'add-task?for=goal';
                    }

                    $todo->delete();


                    return redirect($redirect_url);
                }

                break;

            case 'event':

                $event = Calendar::find($id);
                if ($event){

                    $event->delete();
                    return redirect('/calendar');
                }

                break;

            case 'email-campaign':

                $email_campaign = EmailCampaign::find($id);
                if ($email_campaign){

                    $email_campaign->delete();
                    return redirect('/email-campaigns');
                }

                break;

            case 'sms-campaign':

                $sms_campaign = SmsCampaign::find($id);
                if ($sms_campaign){

                    $sms_campaign->delete();
                    return redirect('/sms-campaigns');
                }

                break;

            case 'sms-setting':

                $sms_setting = SmsProvider::find($id);
                if ($sms_setting){

                    $sms_setting->delete();
                    return redirect('/sms/providers');
                }

                break;

            case 'email-setting':

                $email_setting = EmailProvider::find($id);
                if ($email_setting){

                    $email_setting->delete();
                    return redirect('/email/providers');
                }

                break;

            case 'goal':

                $goal = Goal::find($id);
                if ($goal){

                    $goal->delete();
                    return redirect('/goals');
                }

                break;
            case 'goal-plan':

                $plan = GoalPlan::find($id);
                if ($plan){

                    $plan->delete();
                    return redirect('/plans');
                }

                break;

            case 'to-learn':

                $to_learn = ToLearn::find($id);
                if ($to_learn){

                    $to_learn->delete();
                    return redirect('/tolearn');
                }

                break;
            case 'note':

                $note = Note::find($id);
                if ($note){

                    $note->delete();
                    return redirect('/notes');
                }

                break;


            case 'project':

                $project = Projects::find($id);
                if ($project){

                    $project->delete();
                    return redirect('/projects');
                }

                break;

            case 'journal':

                $journal = FiveMinuteJournal::find($id);
                if ($journal){

                    $journal->delete();
                    return redirect('/gratitude');
                }

                break;

            case 'image':

                $image = Image::find($id);

                if ($image){

                    $image->delete();
                    return redirect('/vision-board');
                }

                break;
            case 'weekly-plan':

                $plan = WeeklyPlan::find($id);
                if ($plan){

                    $plan->delete();
                    return redirect('/weekly-plans');
                }

                break;



            case 'board':

                $board = User::find($id);
    
                if ($board){
    
                    if($board->id === $this->user->id)
                      {
                        abort(401);
                    }
    
                    $board->delete();
    
                    return redirect('/board');

                    }
    
                break;


            case 'staff':

                $staff = User::find($id);

                if ($staff){

                    if($staff->id === $this->user->id)
                    {
                        abort(401);
                    }

                $staff->delete();

                    return redirect('/staff');
                }

                break;

            case 'document':

                $document = Document::find($id);
                if ($document){

                    if(Storage::exists('public/'.$document->path))
                    {
                        Storage::delete('public/'.$document->path);
                    }

                    $document->delete();


                    return redirect('/documents');
                }

                break;


            case 'business-plan':

                $plan = BusinessPlan::find($id);
                if ($plan){

                    $plan->delete();
                    return redirect('/business-plans');
                }

                break;

        }
    }
}
