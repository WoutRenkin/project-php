<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\StudentAcademyYear;
use App\User;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function index()
    {
        $users = User::where('user_kind_id',2)
            ->where('active',1)
            ->get();

        $result = compact('users');
        \Json::dump($result);
        return view('admin.coordinators.index', $result);
    }

    public function create()
    {
        $coordinator = new User();
        $result = compact('coordinator');
        return view('admin.coordinators.create', $result);
    }

    public function store(Request $request)
    {
        $coordinator = new User();
        $coordinator->user_kind_id=2;
        $coordinator->password="";
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'r_number' => 'required|regex:/[a-zA-Z]\d{7}/|unique:users',
            'tel' => 'regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|max:255|unique:users'
        ]);
        $coordinator->first_name = $request->first_name;
        $coordinator->last_name = $request->last_name;
        $coordinator->r_number = $request->r_number;
        $coordinator->email = $request->email;
        $coordinator->active = true;
        $coordinator->save();


        session()->flash('success', 'The coordinator has been added');
        return redirect('admin/coordinators');
    }


    public function edit(User $coordinator)
    {
        $result = compact('coordinator');
        \Json::dump($result);
        return view('admin.coordinators.edit', $result);
    }

    public function update(Request $request, User $coordinator)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'r_number' => 'required|regex:/[a-zA-Z]\d{7}/|unique:users,r_number,'.$coordinator->id,
            'tel' => 'regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email|max:255|unique:users,email,'.$coordinator->id
        ]);
        $coordinator->first_name = $request->first_name;
        $coordinator->last_name = $request->last_name;
        $coordinator->r_number = $request->r_number;
        $coordinator->email = $request->email;
        $coordinator->save();
        session()->flash('success', 'The coordinator has been updated');
        return redirect('admin/coordinators');
    }

    public function destroy(User $coordinator)
    {
        //
    }

    public function deactivate(User $coordinator)
    {
        $coordinator->active = false;
        $coordinator->save();
        session()->flash('success', 'The coordinator has been deactivated');
        return redirect('admin/coordinators');
    }
}
