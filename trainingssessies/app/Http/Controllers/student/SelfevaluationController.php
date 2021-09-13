<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Session;
use DateTime;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\EvaluationSend;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\AcademyYear;
use App\StudentAcademyYear;
use App\User;

class SelfevaluationController extends Controller
{
    public function index(){

        $academyYear = AcademyYear::where('active',1)->firstOrFail();
        $userAcademyYear = Auth::user()->studentAcademyYears->where('academy_year_id', $academyYear->id)->first();
        if($userAcademyYear->team_id == null){
            Session()->flash('message', "Je kan geen reflectieverslag indienen voor je in een team zit!");
            Session()->flash('alert-class', 'alert-danger');
            return redirect('/student/teams');
        }
        $session = Session::where('academy_year_id', $academyYear->id)->where('team_id', $userAcademyYear->team_id)->first();
        $checkDate = new DateTime();
        if($session){
            $timeSession = Carbon::parse($session->date_time);
            if ($timeSession <= $checkDate   && $session->status_id === 3) {
                return view('student.selfevaluation.index',compact('userAcademyYear'));
            } else {
                Session()->flash('message', "Je kan geen reflectieverslag indienen voor je de sessie hebt gegeven!");
                Session()->flash('alert-class', 'alert-danger');
                return redirect('/student/voorstel');
            }
        } else {
            Session()->flash('message', "Je kan geen reflectieverslag indienen voor je een voorstel hebt ingediend!");
            Session()->flash('alert-class', 'alert-danger');
            return redirect('/student/voorstel');
        }
    }

    public function store(Request $request){

        $user = Auth::user();
        $academyYear = AcademyYear::where('active',1)->firstOrFail();
        $userAcademyYear = Auth::user()->studentAcademyYears->where('academy_year_id', $academyYear->id)->first();


        $request->validate([
            'file' => 'required'
        ]);
        
        $extension = request()->file->getClientOriginalExtension();
        $title = "zelfreflectieverslag_" . $user->r_number . "." . $extension;
        //$title = request()->file->getClientOriginalName();
        $request->file->move('files', $title);

        $userAcademyYear->self_evaluation_file = $title;
        $userAcademyYear->save();

        $fullName = $user->first_name . " " . $user->last_name;
        $admins = User::where('user_kind_id', 2)->get();
        Notification::send($admins, new EvaluationSend($userAcademyYear, $fullName));


        return response()->json([
            'title' => $title
        ]);
    }

    public function download(StudentAcademyYear $studentAcademyYear){
        $dl = $studentAcademyYear->self_evaluation_file;
        return response()->download(public_path('files/'.$dl));
    }
}
