<?php

namespace App\Http\Controllers;

use App\Models\FiveMinuteJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GratitudeController extends BaseController
{
    //

    public function gratitude()
    {    $journals= FiveMinuteJournal::all();

        return \view('gratitude.gratitude',[

            'selected_navigation' => 'gratitude',
            'journals'=> $journals
        ]);
    }
    public function diary()
    {

        return \view('gratitude.diary',[

            'selected_navigation' => 'diary',
        ]);
    }
    public function viewJournal(Request $request)
    {
        $journal = false;

        if($request->id)
        {
            $journal = FiveMinuteJournal::find($request->id);
        }

        return \view('gratitude.view-journal',[

            'selected_navigation' => 'gratitude',
            'journal'=> $journal
        ]);
    }

    public function fiveMinuteJournal(Request $request)
    {
        $journal = false;

        if($request->id)
        {
            $journal = FiveMinuteJournal::find($request->id);
        }
        return \view('gratitude.five-min-journal',[

            'selected_navigation' => 'gratitude',
            'journal'=> $journal
        ]);
    }

    public function fiveJournalPost(Request $request)
    {
        $request->validate([


            'id'=>'nullable|integer',
            'date'=>'nullable'

        ]);

        $journal = false;

        if($request->id){

            $journal = FiveMinuteJournal::find($request->id);
        }



        if(!$journal){

            $journal = new FiveMinuteJournal();
            $journal->uuid = Str::uuid();
        }

        $journal->date = $request->date;
        $journal->grateful = clean($request->grateful);
        $journal->habit = clean($request->habit);
        $journal->dream = clean($request->dream);
        $journal->tasks = clean($request->tasks);
        $journal->affirmations = clean($request->affirmations);
        $journal->feeling = clean($request->feeling);
        $journal->dont_waste = clean($request->dont_waste);
        $journal->fav_things = clean($request->fav_things);
        $journal->must_accomplish = clean($request->must_accomplish);


        $journal->save();

        return redirect('/gratitude');


    }
    public function paint()
    {

        return \view('gratitude.paints',[

            'selected_navigation' => 'paint',
        ]);
    }
}
