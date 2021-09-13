<?php

namespace App\Http\Controllers\Admin;

use App\AcademyYear;
use App\Http\Controllers\Controller;
use App\Organisation;
use App\Session;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $myInput = $request->myinput;

        $active_year = AcademyYear::whereActive(true)->first();
        $sessions = Session::with('organisation')
            ->with('status')
            ->where('subject', 'like', '%' . $myInput .'%')
            ->where('status_id' ,'like','4')->where('academy_year_id', $active_year->id)->orderBy('organisation_id','asc')
            ->paginate(10);

        return view('admin.sessions.index', compact('sessions', 'myInput'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = new Session();
        $organisations = Organisation::whereActive(true)
        ->get();
        $teams = Team::get();
        $result = compact('session' , 'organisations','teams');

        return view('admin.sessions.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'organisation_id' => 'required',
            'subject' => 'required',
        ]);
        $session = new Session();

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('files', $name);
            $session->file= $name;
        };

        $session->organisation_id = $request->organisation_id;
        $session->subject = $request->subject;
        $session->status_id= 4; //temp
        $session->academy_year_id = AcademyYear::whereActive(true)->first()->id;

        $session->save();
        session()->flash('message', 'Sessie is succesvol toegevoegd!');
        Session()->flash('alert-class', 'alert-success');
        return response()->noContent();
    }


    public function edit(Session $session)
    {
        $organisations = Organisation::whereActive(true)
            ->get();
        $teams = Team::get();
        $result = compact('session' , 'organisations','teams');
        \Json::dump($result);
        return view('admin.sessions.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {

        $this->validate($request,[
            'subject' => 'required',
            'organisation_id' => 'required',
        ]);

        if($file = $request->file('file')){
            //remove old file
            File::delete(public_path('files/'.$session->file));
            //upload new file
            $name = $file->getClientOriginalName();
            $file->move('files', $name);
            $session->file= $name;
        };

        $session->organisation_id = $request->organisation_id;
        $session->subject = $request->subject;

        $session->save();
        session()->flash('message', 'Sessie  succesvol aangepast!');
        Session()->flash('alert-class', 'alert-success');

        return response()->noContent();

    }

    public function show(Session $session)
    {
        $result = compact('session');
        \Json::dump($result);
        return view('admin.sessions.show', $result);
    }

    public function destroy(Session $session)
    {
        //
    }

    public function download(Session $session)
    {
        $dl = $session->file;
        return response()->download(public_path('files/'.$dl));
    }
}
