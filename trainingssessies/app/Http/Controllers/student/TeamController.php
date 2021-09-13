<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use Auth;
use App\StudentAcademyYear;
use Illuminate\Support\Facades\Mail;
use Session;
use App\AcademyYear;
use App\Mail\StudentTeam;

class TeamController extends Controller
{
    public function index(Request $request)
    {

        $userInfo = null;
        $students = [];
        $users = [];
        $teams = Team::get();
        $academyYear = AcademyYear::where('active', 1)->firstOrFail();
        if ($academyYear != null) {
            $studentAcademyYear = StudentAcademyYear::where('academy_year_id', $academyYear->id)->where('team_id', null)->get();
            foreach ($studentAcademyYear as $student)
                $students[] = (object)$student->user;
        }
        foreach ($teams as $team) {
            $team = $team->GatherStudents($team);
        }
        //Users can be part of multiple academy years but only one student_academy_year in each academy year.
        //We get the team_id of the student_academy_year where the academy year is active.
        $userAcademyYears = Auth::user()->StudentAcademyYears()->get();
        if ($userAcademyYears != null) {
            foreach ($userAcademyYears as $UserAcademyYear) {
                if ($UserAcademyYear->academyYear->active === 1) {
                    $userInfo = $UserAcademyYear;
                }
            }
        }

        return view('student.teams.index', compact('teams', 'userInfo', 'students'));
    }

    public function update(Request $request, Team $team)
    {

        //get studentacademyyear where academyyear is active
        $academyYear = AcademyYear::where('active', 1)->first();
        $userInfo = Auth::user()->StudentAcademyYears()->where('academy_year_id', $academyYear->id)->first();

        //Let's get user full name for sending a mail later.
        $userFullName = $userInfo->user->first_name . " " . $userInfo->user->last_name;

        //Gather current students
        $team->GatherStudents($team);

        //First check, if submit button presses was inschrijven we do the subscribe process, else we do the unsubscribe process.
        if ($request->input('submitButton') == "inschrijven") {

            //Array which will add the new users in our team.
            $newUsers = [];

            //Add auth user in the new users array if he isn't already in it.
            if ($userInfo->team_id == null) {
                $newUsers[] = (object)$userInfo;
            }

            //We have max 2 new students so we will loop twice.
            for ($i = 0; $i < 2; $i++) {

                //We combine student with $0
                $student = "student" . $i;
                if ($request->$student != 0) {
                    $user = StudentAcademyYear::Where('student_id', $request->$student)->Where('academy_year_id', $academyYear->id)->first();
                    if ($user != null && $user->team_id == null) {
                        $newUsers[] = (object)$user;
                    } else {
                        Session()->flash('message', "Sorry inschrijving niet gelukt, iemand dat je wou toevoegen zit al in een team, zorg er voor dat je alleen mensen toevoegd die nog niet in een team zitten.");
                        Session()->flash('alert-class', 'alert-danger');
                        return redirect('student/teams');;
                    }
                }
            }
            if (3 - Count($team->students) - Count($newUsers) < 0) {
                Session()->flash('message', "Sorry, inschrijving is niet gelukt, er zouden te veel mensen in het team zitten...");
                Session()->flash('alert-class', 'alert-danger');
            } else {
                foreach ($newUsers as $student) {
                    $student->team_id = $team->id;
                    $student->save();
                    if ($student->id != $userInfo->id) {
                        $fullname = $student->user->first_name . " " . $student->user->last_name;
                        Mail::to($student->user->email)->send(new StudentTeam($team->name, $userFullName, $fullname));
                    }

                }
                Session()->flash('message', "Je hebt jezelf ingeschreven in team " . $team->name . "!");
                Session()->flash('alert-class', 'alert-success');
                if (count($team->students) + Count($newUsers) == 3) {
                    Team::where('id', $team->id)->update(['full' => true]);
                }
            }
        } else {
            //If team had 3 students, update full value to false.
            if (count($team->students) === 3) {
                Team::where('id', $userInfo->team_id)->update(['full' => false]);
            }

            $team = $team->gatherStudents($team);
            if(count($team->students) === 1) {
                $team = $team->GatherSession($team);
                if($team->session) {
                    $session = $team->session;
                    $session->status_id = 4;
                    $session->responsible_id = null;
                    $session->date_time = null;
                    $session->team_id = null;
                    $session->amount_cursisten = null;
                    $session->profile_curstist = null;
                    $session->goals = null;
                    $session->expected_knowledge = null;
                    $session->activities = null;
                    $session->infrastructure_materials = null;
                    $session->responsible_docent = null;
                    $session->seen = false;
                    $session->save();
                }
            }
            $userInfo->team_id = null;
            $userInfo->save();
            Session()->flash('message', "Je hebt jezelf uitgeschreven uit team " . $team->name . "!");
            Session()->flash('alert-class', 'alert-danger');

        }

        return redirect('student/teams');;

    }

}
