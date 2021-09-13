<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Session;
use App\StudentAcademyYear;
use App\Team;
use App\User;
use App\AcademyYear;


class CalendarController extends Controller
{
    public function index(){
        $user = \Auth::user();
        $session = null;
        $StudentAcademyYear = StudentAcademyYear::where('student_id',$user->id)->first();
        $academyYear = AcademyYear::where('active',1)->first();

        $team = Team::whereId($StudentAcademyYear->team_id)->first();
        if($team != null){
            $session = Session::where('academy_year_id', $academyYear->id)->where('team_id', $team->id)->where('status_id', 3)->get();
        }

        return view('student.calendar.index', compact('session'));
    }
}
