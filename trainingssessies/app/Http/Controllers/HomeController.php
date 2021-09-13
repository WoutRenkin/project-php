<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AcademyYear;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->user_kind_id == 1){

            $academyYear = AcademyYear::where('active',1)->firstOrFail();
            $userAcademyYears = Auth::user()->StudentAcademyYears()->where('academy_year_id', $academyYear->id)->first();


            return view('home', compact('userAcademyYears'));
        }
        else{
            return redirect('/admin/teams');
        }

    }
}
