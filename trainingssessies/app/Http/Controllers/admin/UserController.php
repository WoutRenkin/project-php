<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Team;
use App\User;
use App\StudentAcademyYear;
use App\AcademyYear;
use Hash;
use Illuminate\Http\Request;
use Log;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $team = $request->input('team');
        $name = '%' . $request->input('name') . '%';
        $active = $request->input('active'); //1 = inactive, 2 = active, 0 = beide

        //get active year
        $active_year = AcademyYear::whereActive(true)->first()->id;
        $year_filter = $request->input('academy_year') ?? $active_year;

        $academy_years = AcademyYear::get();


        //lijst met studenten ophalen
        if($team == 1){
            $users = StudentAcademyYear::leftJoin('users', 'student_id', '=', 'users.id')
                    ->where('team_id', 'like', '%')
                    ->where('academy_year_id',$year_filter)
                    //->where('user_kind_id',1)
                    ->where('active','!=', $active)
                    ->where(function ($query) use ($name) {
                        $query->where('first_name', 'like', $name)
                            ->orWhere('last_name', 'like', $name)
                            ->orWhere('r_number', 'like', $name);
                    })->orderby('first_name','asc')->paginate(10);
        }
        if($team == 2){
            $users = StudentAcademyYear::leftJoin('users', 'student_id', '=', 'users.id')
                ->whereNull('team_id')
                ->where('academy_year_id',$year_filter)
                //->where('user_kind_id',1)
                ->where('active','!=', $active)
                ->where(function ($query) use ($name) {
                    $query->where('first_name', 'like', $name)
                        ->orWhere('last_name', 'like', $name)
                        ->orWhere('r_number', 'like', $name);
                })->orderby('first_name','asc')
                ->paginate(10);
        }
        if($team == 0) {
            //teams maken niet uit
            $users = StudentAcademyYear::leftJoin('users', 'student_id', '=', 'users.id')
                //->where('user_kind_id',1)
                ->where('active','!=', $active)
                ->where('academy_year_id',$year_filter)
                ->where(function ($query) use ($name) {
                    $query->where('first_name', 'like', $name)
                        ->orWhere('last_name', 'like', $name)
                        ->orWhere('r_number', 'like', $name);
                })->orderby('first_name','asc')
                ->paginate(10);
        }



        $result = compact('users', 'academy_years' , 'active_year' ,'year_filter', 'name' ,'active', 'team');
        \Json::dump($result);
        return view('admin.users.students.index', $result);
    }

    public function admin(Request $request)
    {
        $name = '%' . $request->input('name') . '%';
        $users = User::where('user_kind_id',2)
            ->where(function ($query) use ($name) {
            $query->where('first_name', 'like', $name)
                ->orWhere('last_name', 'like', $name)
                ->orWhere('r_number', 'like', $name);
        })->orderby('first_name','asc')
            ->paginate(10);

        $result = compact('users','name');
        \Json::dump($result);
        return view('admin.users.admins.index', $result);
    }

    public function create()
    {
        $student = new User();
        $result = compact('student');
        return view('admin.users.students.create', $result);
    }

    public function store(Request $request)
    {
        $student = new User();

        $student->password="";
        $this->validate($request,[
            'user_kind_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'r_number' => 'required|regex:/[a-zA-Z]\d{7}/|unique:users',
            'tel' => 'regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|max:255|unique:users'
        ], [
            'r_number.regex' => 'Geen juiste r-nummer ingegeven. Voorbeeld(r0631168)',
            'r_number.unique' => 'Er bestaat al een gebruiker met deze r-nummer.',
            'tel.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032.',
            'email.max' => 'E-mailadres mag niet meer dan 255 tekens bevatten.',
            'email.unique' => 'Sorry, dit email is al in gebruik.'
        ]);

        $student->user_kind_id=$request->user_kind_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->r_number = $request->r_number;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->password = Hash::make('secret');
        $student->active = true; //misschien is het de bedoeling dat een gebruiker active is wanneer het acc geactiveerd wordt

        $student->save();

        if($student->user_kind_id == 1) {
            // StudentAcademyYear aanmaken
            $student_academy_year = new StudentAcademyYear();
            $student_academy_year->student_id = $student->id;
            $student_academy_year->academy_year_id = AcademyYear::whereActive(true)->first()->id;
            $student_academy_year->save();

            session()->flash('success', 'The student is toegevoegd');
            Session()->flash('alert-class', 'alert-success');
            return redirect('admin/students');
        }else{
            session()->flash('success', 'The Administrator is toegevoegd');
            Session()->flash('alert-class', 'alert-success');
            return redirect('admin/admins');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     */
    public function edit(User $student)
    {
        $result = compact('student');
        \Json::dump($result);
        return view('admin.users.students.edit', $result);
    }

    public function update(Request $request, User $student)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'r_number' => 'required|regex:/[a-zA-Z]\d{7}/|unique:users,r_number,'.$student->id,
            'tel' => 'regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|max:255|unique:users,email,'.$student->id
        ],
            [
                'r_number.regex' => 'Geen juiste r-nummer ingegeven. Voorbeeld(r0631168)',
                'r_number.unique' => 'Er bestaat al een gebruiker met deze r-nummer.',
                'tel.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032.',
                'email.max' => 'E-mailadres mag niet meer dan 255 tekens bevatten.',
                'email.unique' => 'Sorry, dit email is al in gebruik.'
            ]);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->r_number = $request->r_number;
        $student->email = $request->email;
        $student->tel = $request->tel;
        $student->save();
        session()->flash('success', 'De student is geüpdatet');
        Session()->flash('alert-class', 'alert-success');
        return redirect('admin/students');
    }

    public function addToYear(User $student)
    {
        $student_academy_year = new StudentAcademyYear();
        $student_academy_year->student_id = $student->id;
        $student_academy_year->academy_year_id = AcademyYear::whereActive(true)->first()->id;
        $student_academy_year->save();

        session()->flash('success', 'De student is toegevoegd aan het huidige academie jaar');
        Session()->flash('alert-class', 'alert-success');
        return redirect('admin/students');
    }

    //custom functie om een gebruiker te deactiveren (Niet verwijderen)
    public function deactivate(User $student)
    {
        $student->active = false;
        $student->save();

        //student wordt uit het team gesmeten waar hij/zij in zat.
        $active_year = AcademyYear::whereActive(true)->first()->id;
        $student_academy_year = StudentAcademyYear::where('student_id',$student->id)
            ->where('academy_year_id',$active_year)
            ->first();
        $student_academy_year->team_id = null;
        $student_academy_year->save();

        session()->flash('success', 'The student is gedeactiveert');
        Session()->flash('alert-class', 'alert-success');
        return redirect('admin/students');
    }

    public function activate(User $student)
    {
        $student->active = true;
        $student->save();

        session()->flash('message', 'The student is geactiveert');
        Session()->flash('alert-class', 'alert-success');

    }

    //functie om gebruikers uit een excel bestand in de database toe te voegen
    public function excel(Request $request)
    {
        $file = $request->file('file');
        $usersImport = new UsersImport;
        $usersImport->import($file);

        session()->flash('message', 'Succesvol geïmporteerd');
        Session()->flash('alert-class', 'alert-success');

        return response()->json([
            'file' => $file
        ]);
    }

    public function download(StudentAcademyYear $studentAcademyYear){
        $dl = $studentAcademyYear->self_evaluation_file;
        return response()->download(public_path('files/'.$dl));
        //nog te testen.
    }


}
