<?php

namespace App\Http\Controllers\Admin;

use App\AcademyYear;
use App\Http\Controllers\Controller;
use App\StudentAcademyYear;
use App\Team;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\User;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class TeamController extends Controller
{


    public function index(Request $request){
        $team_filter = $request->input('team_filter');
        $myinput= $request->input('myinput');
        $sessie_filter = $request->input('sessie_filter');

        switch ($team_filter) {
            case 2:
                $teams = Team::where('full', true)->get();;
                break;
            case 3:
                $teams = Team::where('full', false)->get();;
                break;
            default:
                $teams = Team::get();
        }

        foreach($teams as $team){
            $team = $team->GatherSession($team);
            $team = $team->GatherStudents($team);
            if (count($team->students) === 3){
                if($team->full == false){
                    Team::Where('id', $team->id)->update(['full' => true]);
                }
            } else {
                if($team->full == true){
                    Team::Where('id', $team->id)->update(['full' => false]);
                }
            }
        }

        if($team_filter == 3){
            $emptyteams = [];
            foreach($teams as $team){
                if(count($team->students) === 0){
                    $emptyteams[] = $team;
                }
            }
            $teams = $emptyteams;
        }


        if($sessie_filter != "0" && $sessie_filter != null){
            $sessionFilterTeams = [];
            foreach($teams as $team) {
                if($sessie_filter === "geenstatus"){
                    if(!$team->status) {
                        $sessionFilterTeams[] = $team;
                    }
                } else {
                    if($team->status){
                        if($team->status->description == $sessie_filter){
                            $sessionFilterTeams[] = $team;
                        }
                    }
                }

                $teams = $sessionFilterTeams;
            }
        }

        /*if(is_array($teams)) {
            $teams = $this->paginate($teams, 4);
        }*/

      return view('admin.teams.index', ['teams' => $teams, 'team_filter'=>$team_filter, 'myinput' =>$myinput, 'sessie_filter' => $sessie_filter]);

    }

    public function edit(Team $team){

        $team = $team->GatherStudents($team);
        $users = User::Where("active", true)->where('user_kind_id',1)->get();
        return view('admin.teams.edit', ['team'=>$team, 'users'=>$users]);
    }

    public function update(Request $request){
        //Get active academy year
        $active_year = AcademyYear::whereActive(true)->first();

        //Get team we will update
        $team = Team::where('id', $request->team)->first();

        //Gather students that are currently in team
        $team->gatherStudents($team);

        //Check if the id of the current team students are in the new team composition. If not we will set team_id to null.
        foreach($team->students as $student){
            if(!in_array($student->id, $request->students)){
                $studentAcademyYear = StudentAcademyYear::where('academy_year_id', $active_year->id)->where('student_id', $student->id)->first();
                $studentAcademyYear->team_id = null;
                $studentAcademyYear->save();
            }
        }

        //Lets now add the new students in this team.
        $students = StudentAcademyYear::where('academy_year_id', $active_year->id)->whereIn('student_id', $request->students)->get();
        foreach($students as $student) {
            $student->team_id = $request->team;
            $student->save();
        }

        Session()->flash('message', "Je hebt team ". $team->name ." succesvol geüpdatet!");
        Session()->flash('alert-class', 'alert-success');


        return response()->json(['url'=>url('admin/teams')]);
    }

    public function store(){
        $team = Team::all()->last();
        $number = $team->name + 1;
        $nextTeam = new Team;
        $nextTeam->name = $number;
        $nextTeam->save();

        Session()->flash('message', "Je hebt team ". $nextTeam->name ." succesvol toegevoegd!");
        Session()->flash('alert-class', 'alert-success');

        return redirect('admin/teams');
    }

    public function checkStudents(Request $request) {
        $studentsGroup = [];

        $active_year = AcademyYear::whereActive(true)->first();

        $students = StudentAcademyYear::where('academy_year_id', $active_year->id)->whereIn('student_id', $request->students)->get();

        foreach($students as $student){
            if($student->team_id){
                $student->user["team"] = true;
            } else {
                $student->user["team"] = false;
            }
            if($student->team_id != $request->team){
                $studentsGroup[] = (Object) $student->user;
            }
        }

        return response()->json([
            'students' => $studentsGroup
        ]);
    }

    /*public function paginate($items,$perPage)
    {
        $pageStart = \Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;

        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);


        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }*/


}

