<?php

namespace App\Http\Controllers\docent;

use App\AcademyYear;
use App\DocentSession;
use App\Http\Controllers\Controller;
use App\Session;
use App\SessionToken;
use Illuminate\Http\Request;
use Response;

class SessionController extends Controller
{
    public function calendar($token)
    {
        if($this->checkToken($token)){
            $academyYear = AcademyYear::where('active',1)->first();

            $session = Session::where('academy_year_id', $academyYear->id)->where('status_id', 3)->get();


            return view('docent.index', compact('session','token'));
        }
        else{
            abort(404,'token bestaat niet of is vervallen');
        }


    }
    public function show($token, $id)
    {
        if($this->checkToken($token)) {

            $session = Session::whereId($id)
                ->with('organisation')
                ->first();
            if ($session) {
                if ($session->status_id == 3) {
                    $docentSessions = DocentSession::whereSessionId($session->id)
                        ->get();
                    return view('docent.show', compact('session', 'docentSessions', 'token'));
                }
            }
        }

        abort(404,'token bestaat niet of is vervallen');



    }

    public function store($token, $id, Request $request)
    {

        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $docentSession = new DocentSession();
        $docentSession->session_id = $id;
        $docentSession->first_name = $request->first_name;
        $docentSession->last_name = $request->last_name;

        $docentSession->save();

        return Response()->json(['a'=> "a"]);

    }

    public function checkToken($token)
    {
        $a = SessionToken::whereRaw("BINARY `token`= ?",[$token])->first();
        if($a){
            return true;
        }
        else{
            return false;
        }


    }


}
