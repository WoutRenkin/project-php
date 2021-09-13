<?php

namespace App\Http\Controllers\student;

use App\AcademyYear;
use App\Http\Controllers\Controller;
use App\Organisation;
use App\Session;
use App\Status;
use App\StudentAcademyYear;
use App\Team;
use App\User;
use Notification;
use App\Notifications\SessionSend;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index(Request $request){


        $name = $request->input('name');
        $user = \Auth::user();

        $StudentAcademyYear = StudentAcademyYear::where('student_id',$user->id)->first();
        $academyYear = AcademyYear::where('active',1)->firstOrFail();
        //check if user is in een team
        if($StudentAcademyYear->team_id == null){
            Session()->flash('message', "Je kan geen voorstel indienen voor je in een team zit!");
            Session()->flash('alert-class', 'alert-danger');
            return redirect('/student/teams');
        }
        $teams = Team::whereId($StudentAcademyYear->team_id)->first();
        $Sessies = Session::where('academy_year_id',$academyYear->id)->where('team_id',$teams->id)->get();


        //als er nog geen voorstel ingediend is -> lijst van sessies
        if($Sessies->first()){
            $status = Status::get();
            $organisations = Organisation::get();
            $result = compact('Sessies', 'teams','status','organisations');
            \Json::dump($result);

            return view('student.Suggestion.index', $result);
        }else{
                $sessions = Session::with('organisation')
                    ->with('status')
                    ->where('status_id' ,'like','4')
                    ->where('academy_year_id',$academyYear->id)
                    ->where('subject', 'like','%' . $name . '%')
                    ->orderBy('subject','asc')
                    ->paginate(10);
                $result = compact('sessions','name');
                \Json::dump($result);


                return view('student.session.index', $result);

        }

    }
    public function create(){

        $user = \Auth::user();
        $academyYear = AcademyYear::where('active',1)->firstOrFail();
        //check if user is in een team
        $StudentAcademyYear = StudentAcademyYear::where('student_id',$user->id)->first();
        if($StudentAcademyYear->team_id == null){
            Session()->flash('message', "Je kan geen voorstel indienen voor je in een team zit!");
            Session()->flash('alert-class', 'alert-danger');
            return redirect('/student/teams');
        }
        $session = new Session();
        $sessions = Session::where('status_id', 4)->where('academy_year_id',$academyYear->id)->get();
        $organisations = Organisation::whereActive(true)
            ->get();
        $result = compact('organisations','session','sessions');
        return view('student.Suggestion.create', $result);
    }
    public function store(Request $request)
    {

        $this->validate($request,[
        'organisation_id' => 'required',
        'amount_cursisten' => 'required|numeric|gt:0',
        'profile_cursist' => 'required',
        'goals' => 'required',
        'expected_knowledge'=>'required',
        'date_time'=>'required',
        'infrastructure_materials'=> 'required',
            'activities'=>'required'
    ],[     'amount_cursisten.gt' => 'Het aantal moet groter zijn dan 0',
        ]);
        //user binnenhalen
        $user = \Auth::user();
        $StudentAcademyYear = StudentAcademyYear::where('student_id',$user->id)->first();
        $AcademyYear = AcademyYear::where('active',true)->first();
        //Sesion maken

        $Session = Session::where('organisation_id',$request->organisation_id)->where('status_id',4)->where('academy_year_id',$AcademyYear->id)->firstOrFail();
        $Session->team_id = $StudentAcademyYear->team_id;
        $Session->status_id = 1;
        $Session->responsible_id = $StudentAcademyYear->id;
        $Session->date_time = $request->date_time;
        $Session->amount_cursisten = $request->amount_cursisten;
        $Session->profile_curstist = $request->profile_cursist;
        $Session->goals = $request->goals;
        $Session->expected_knowledge = $request->expected_knowledge;
        $Session->activities = $request->activities;
        $Session->infrastructure_materials = $request->infrastructure_materials;
        $Session->responsible_docent = $request->responsible_docent;
        $Session->seen = false;
        $Session->save();
        $students = StudentAcademyYear::where('team_id',$StudentAcademyYear->team_id)->where('academy_year_id', $AcademyYear->id)->get();
        foreach ($students as $student){
            $eachstudent = User::where('id',$student->student_id)->firstOrFail();
            $eachstudent->session_voorstel_uploaded = 1;
            $eachstudent->save();
        }

        $fullName = $user->first_name . " " . $user->last_name;
        $admins = User::where('user_kind_id', 2)->get();
        $team = Team::whereId($StudentAcademyYear->team_id)->first();
        Notification::send($admins, new SessionSend($Session, $team->name, $fullName));

        Session()->flash('message', "Je hebt succesvol een voorstel ingediend!");
        Session()->flash('alert-class', 'alert-success');
        return redirect('/student/voorstel');
    }
    public function edit($session){

        //check if session is van het team waar de user in zit
        $session=Session::findOrFail($session);
        $user = \Auth::user();
        $StudentAcademyYear = StudentAcademyYear::where('student_id',$user->id)->first();
        if($StudentAcademyYear->team_id != $session->team_id){
            Session()->flash('message', "Je kan geen voorstel bekijken/aanpassen van een ander team!");
            Session()->flash('alert-class', 'alert-danger');
            return redirect('/student/voorstel');
        }
        //alle actieve organisaties binne halen
        $organisations = Organisation::whereActive(true)
            ->get();
        $result = compact("session","organisations");
        \Json::dump($result);
        return view('student.Suggestion.edit',$result);
    }
    public function update(Request $request,$session){

        $user = \Auth::user();

        if($request->button == 1){
            return redirect('student/voorstel');
        }
        else{
            $this->validate($request,[
                'amount_cursisten' => 'required|numeric|gt:0',
                'profile_cursist' => 'required',
                'goals' => 'required',
                'expected_knowledge'=>'required',
                'infrastructure_materials'=> 'required',
                'activities'=>'required'
            ],[     'amount_cursisten.gt' => 'Het aantal moet groter zijn dan 0',
            ]);
            $Session = Session::findOrFail($session);
            $Session->status_id = 1;
            $Session->amount_cursisten = $request->amount_cursisten;
            $Session->profile_curstist = $request->profile_cursist;
            $Session->goals = $request->goals;
            $Session->expected_knowledge = $request->expected_knowledge;
            $Session->activities = $request->activities;
            $Session->infrastructure_materials = $request->infrastructure_materials;
            $Session->responsible_docent = $request->responsible_docent;
            $Session->feedback = "";
            $Session->seen = false;
            //save alles

            $Session->save();

            $fullName = $user->first_name . " " . $user->last_name;
            $admins = User::where('user_kind_id', 2)->get();
            Notification::send($admins, new SessionSend($Session, $Session->team_id, $fullName));

            Session()->flash('message', "Je hebt succesvol een voorstel geupdate!");
            Session()->flash('alert-class', 'alert-success');
            return redirect('student/voorstel');
        }

    }

    public function download(Session $session)
    {
        $dl = $session->file;
        return response()->download(public_path('files/'.$dl));
    }

    public function sendMessage(User $user, $teamId, Session $session){
        //send notification to admins
        $fullName = $user->first_name . " " . $user->last_name;
        $admins = User::where('user_kind_id', 2)->get();
        $team = Team::whereId($teamId)->first();
        Notification::send($admins, new SessionSend($session, $team->name, $fullName));
    }


}
