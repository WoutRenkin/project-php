<?php

namespace App\Http\Controllers\Admin;

use App\AcademyYear;
use App\Http\Controllers\Controller;
use App\Organisation;
use App\Session;
use App\Status;
use App\StudentAcademyYear;
use App\Team;
use App\User;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function index(Request $request){

        $sessie_filter = $request->input('sessie_filter');
        $sessie_seen = $request->input('sessie_seen');
        $teams = Team::get();
        $AcademyYear = AcademyYear::where('active', 1)->firstOrFail();


        switch ($sessie_seen) {
            case 1:
                $sessie_seen = 1;
                break;
            case 2:
                $sessie_seens = true;
                break;
            case 3:
                $sessie_seens = false;
                break;
            default:
                $sessie_seen = 1;
        }
        if($sessie_seen != 1){
            switch ($sessie_filter) {
                case 1:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[1,2,3])->where('seen',$sessie_seens)->paginate(10);
                    break;
                case 2:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->where('seen',$sessie_seens)->whereIn('status_id',[1])->paginate(10);
                    break;
                case 3:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->where('seen',$sessie_seens)->whereIn('status_id',[3])->paginate(10);
                    break;
                case 4:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->where('seen',$sessie_seens)->whereIn('status_id',[2])->paginate(10);
                    break;
                default:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[1,2,3])->where('seen',$sessie_seens)->paginate(10);
            }
        }
        else{
            switch ($sessie_filter) {
                case 1:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[1,2,3])->paginate(10);;
                    break;
                case 2:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[1])->paginate(10);;
                    break;
                case 3:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[3])->paginate(10);;
                    break;
                case 4:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[2])->paginate(10);;
                    break;
                default:
                    $Sessies = Session::where('academy_year_id',$AcademyYear->id)->whereIn('status_id',[1,2,3])->paginate(10);
            }
        }

        $status = Status::get();
        $StudentAcademyYear = StudentAcademyYear::get();
        $users = User::where('user_kind_id',1)
            ->where('active',1)
            ->get();


        foreach($teams as $team){
            $team = $team->GatherStudents($team);
        }
        $result = compact('Sessies', 'teams', 'StudentAcademyYear', 'users','status','sessie_filter','sessie_seen');
        \Json::dump($result);
        return view('admin.Suggestion.index', $result);
    }
    public function edit($session)
    {

        $session=Session::findOrFail($session);
        $organisations = Organisation::whereActive(true)
            ->get();
        $session->seen = true;
        $session->save();
        $result = compact("session","organisations");
        \Json::dump($result);
        return view('admin.Suggestion.edit',$result);
    }

    public function update(Request $request, $Session)
    {
        $updatedsession = Session::findOrFail($Session);
        if($updatedsession->status_id != $request->button){
            $updatedsession->feedback = $request->feedback;
            $updatedsession->status_id = $request->button;
            $updatedsession->save();
            Session()->flash('message', "Je hebt succesvol feedback gegeven!");
            Session()->flash('alert-class', 'alert-success');
        }
        return redirect('admin/voorstel');
    }
}
