<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{
    //

    public function documents()
    {

        $documents = Document::all();

        return \view('documents',[
            'selected_navigation' => 'documents',
            'documents'=>$documents,
        ]);
    }

    public function documentPost(Request $request)
    {

        if(config('app.env') === 'demo')
        {

            return;

        }

        $request->validate([
            'file'=>'required|mimes:jpeg,bmp,png,gif,svg,pdf'
        ]);
        $path = false;
        if($request->file)
        {

            $path = $request->file('file')->store('public');
            $path = str_replace('public/','',$path);


        }



          $document = new Document();
          $document->uuid = Str::uuid();
          $document->name= $path;
          $document->path= $path;
          $document->name = $request->file('file')->getClientOriginalName();
          $document->save();

    }
}
