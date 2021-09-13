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
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AcademyYearController extends Controller
{
public function index(){

    //alle academyyears binnehalen
    $academyYear = AcademyYear::orderBy('id','desc')->get();
    $result = compact('academyYear');
    return view('admin.academyYear.index',$result);
}
    public function create(){

        $academiejaars = AcademyYear::get();

        $academiejaar = new AcademyYear();
        $date = new DateTime($academiejaars->last()->end_date);
        $academiejaar->start_date = Carbon::parse($date->add(new DateInterval("P1D")));
        $academiejaar->end_date = Carbon::parse($date->add(new DateInterval("P1Y")));
        $academiejaar->name_year = $academiejaar->start_date->year . '-' . $academiejaar->end_date->year;
        $academiejaar->active = 0;
        $academiejaar->save();

        Session()->flash('message', "Je hebt succesvol het academiejaar ($academiejaar->name_year) toegevoegd!");
        Session()->flash('alert-class', 'alert-success');
        return redirect('admin/academiejaar');
    }
    public function activate($id)
    {

        if(AcademyYear::where("Active",1)->get()->count() != 0){
            $activeacademiejaar = AcademyYear::whereActive(1)->firstOrFail();
            $activeacademiejaar->active = 0;
            $activeacademiejaar->save();
        }
        $academiejaar = AcademyYear::whereId($id)->firstOrFail();
        $academiejaar->active = 1;
        $academiejaar->save();
        Session()->flash('message', "Je hebt succesvol het academiejaar ($academiejaar->name_year) geactiveerd!");
        Session()->flash('alert-class', 'alert-success');
        return redirect('admin/academiejaar');
    }

}
