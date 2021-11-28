<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends BaseController
{
    //

    public function download($id)
    {
        $document = Document::find($id);
        if ($document){

            $path = storage_path('app/public/'.$document->path);

            if(file_exists($path))
            {
                return response()->download($path);
            }

            return redirect('/documents');
        }

    }






}
