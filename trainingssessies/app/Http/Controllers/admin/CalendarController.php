<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AcademyYear;
use App\Session;

class CalendarController extends Controller
{
    public function index(){

        $academyYear = AcademyYear::where('active',1)->first();

        $session = Session::where('academy_year_id', $academyYear->id)->where('status_id', 3)->get();


        return view('admin.calendar.index', compact('session'));
    }
}
