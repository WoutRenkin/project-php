<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        $files = File::orderBy('created_at', 'desc')
            ->get();
        $result = compact('files');


        return view('admin.documents.index', $result);
    }

    public function create(){
        return view('admin.documents.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ],
            ['name.required'=> 'Selecteer een bestand!',
                'start_time.required' => 'Kies een tijd voor wanneer het document beschikbaar gesteld wordt.',
                'end_time.required' => 'Kies een tijd voor wanneer het document gedeactiveerd wordt.',
                'end_time.after'=> 'Deze datum moet na de datum van beschikbaarheid komen.']);


        $file = new File();
        $filename = $request->file('name')->getClientOriginalName();


        $request->file('name')->move('files', $filename);
        File::where('name',$filename)->delete();
        $file->name = $filename;
        $file->available_from = request()->start_time;
        $file->available_until = request()->end_time;
        $file->save();

        Session()->flash('message', $filename." is geupload!");
        Session()->flash('alert-class', 'alert-success');

        return redirect('admin/documents');


    }
    public function download(File $file)
    {
        $dl = $file->name;
       return response()->download(public_path('files/'.$dl));
    }
    public function edit($file){
        $file=File::findOrFail($file);
        $result = compact("file");
        \Json::dump($result);

        return view('admin.documents.edit', $result);
    }

    public function update(Request $request, File $file){

        $File = File::where('name', $request->name)->first();

        $File->name = request()->name;
        $File->available_from = request()->start_time;
        $File->available_until = request()->end_time;

        $File->save();
        Session()->flash('message', "Je hebt ".request()->name." geupdate!");
        Session()->flash('alert class', 'alert-success');
        return redirect('admin/documents');

    }


    public function updateActive(File $file, Request $request){
        if($request->updateActive === "deactivate") {


            $file->available_until = Carbon::now()->subMinute();
            $file->save();

            Session()->flash('message', "Je hebt ". $file->name ." succesvol gedeactiveerd!");
            Session()->flash('alert-class', 'alert-danger');

        }  else {
            $file->available_from = Carbon::now();

            if($file->available_until <= $file->available_from ) {
                $file->available_until = Carbon::now()->addMonth();
            }
            $file->save();
            Session()->flash('message', "Je hebt ". $file->name ." succesvol geactiveerd!");
            Session()->flash('alert-class', 'alert-success');

        }
        return redirect('admin/documents');


    }


}
