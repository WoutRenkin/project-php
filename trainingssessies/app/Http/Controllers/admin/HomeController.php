<?php

namespace App\Http\Controllers\Admin;

use App\AcademyYear;
use App\Http\Controllers\Controller;
use App\Session;
use App\Status;
use App\StudentAcademyYear;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
            $AcademyYear = AcademyYear::where('active', 1)->firstOrFail();
            $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[5,7,6])->get();
            $teams = Team::get();

        $status = Status::get();
        $StudentAcademyYear = StudentAcademyYear::get();
        $users = User::where('user_kind_id',1)
            ->where('active',1)
            ->get();


        foreach($teams as $team){
            $team = $team->GatherStudents($team);
        }
        $result = compact('Sessies', 'teams', 'StudentAcademyYear', 'users','status');
        \Json::dump($result);
        return view('admin/home',$result);
    }
}
