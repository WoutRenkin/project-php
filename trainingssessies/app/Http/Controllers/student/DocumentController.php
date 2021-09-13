<?php

namespace App\Http\Controllers\Student;

use App\File;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        //get all files that are currently active and order by most recently made available
        $files = File::where('available_from', '<=', Carbon::now())
            ->where('available_until', '>=', Carbon::now())
            ->orderBy('available_from', 'desc')
            ->get();
        $result = compact('files');

        return view('student.documents.index', $result);
    }
    public function download(File $file)
    {
        $dl = $file->name;
        return response()->download(public_path('files/'.$dl));
    }
}
