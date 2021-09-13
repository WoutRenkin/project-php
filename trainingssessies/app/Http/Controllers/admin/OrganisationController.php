<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function index(Request $request){
        $active_filter = $request->active_filter;
        $myinput= $request->input('myinput');

        switch($active_filter){
            case 1:
                $organisations = Organisation::orderBy('name', 'asc')->whereActive(true)->where('name', 'like', '%' . $myinput .'%')->paginate(10);
                break;
            case 2:
                $organisations = Organisation::orderBy('name', 'asc')->whereActive(false)->where('name', 'like', '%' . $myinput .'%')->paginate(10);
                break;
            default:
                $organisations = Organisation::orderBy('name', 'asc')->whereActive(true)->where('name', 'like', '%' . $myinput .'%')->paginate(10);

        }

        return view('admin.organisations.index', ['organisations' => $organisations, 'active_filter' => $active_filter, 'myinput' => $myinput]);

    }

    public function create(){
        return view('admin.organisations.create');
    }

    public function store(){

        Organisation::create($this->validateOrganisation());
        Session()->flash('message', "Je hebt succesvol een nieuwe organisatie toegevoegd.");
        Session()->flash('alert-class', 'alert-success');

        return redirect('admin/organisations');
    }

    public function edit(Organisation $organisation){

        return view('admin.organisations.edit', ['organisation'=>$organisation]);
    }

    public function update(Organisation $organisation){


        $organisation->update($this->validateUpdateOrganisation($organisation->id));

        Session()->flash('message', "Je hebt ". $organisation->name ." succesvol geüpdatet!");
        Session()->flash('alert-class', 'alert-success');

        return redirect('admin/organisations');
    }

    public function show(Organisation $organisation) {
        return view('admin.organisations.show', ['organisation' => $organisation]);
    }

    public function updateActive(Organisation $organisation, Request $request){
        if($request->updateActive === "deactivate") {
            $organisation->active = false;
            $organisation->save();

            Session()->flash('message', "Je hebt ". $organisation->name ." succesvol gedeactiveerd!");
            Session()->flash('alert-class', 'alert-danger');

        } else {
            $organisation->active = true;
            $organisation->save();

            Session()->flash('message', "Je hebt ". $organisation->name ." succesvol geactiveerd!");
            Session()->flash('alert-class', 'alert-success');

        }
        return redirect('admin/organisations');
    }

    protected function validateOrganisation()
    {
        return request()->validate([
            'name'=>'required',
            'contact_person' => 'required',
            'email'=>'required|string|email|max:255|unique:organisations',
            'tel_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'place'=>'required',
            'address'=>'required',
            'description'=>'nullable',
        ],
            [
                'tel_number.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032.',
                'tel_number.min' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032.',
                'email.max' => 'E-mailadres mag niet meer dan 255 tekens bevatten.',
                'email.unique' => 'Sorry, dit email is al in gebruik.'
            ]);
    }
    protected function validateUpdateOrganisation($id)
    {

        return request()->validate([
            'name'=>'required',
            'contact_person' => 'required',
            'email'=>'required|string|email|max:255|unique:organisations,email,'.$id,
            'tel_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'place'=>'required',
            'address'=>'required',
            'description'=>'nullable',
        ],
            [
                'tel_number.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
                'tel_number.min' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
                'email.unique' => 'Sorry, dit e-mailadres is al in gebruik.',
            ]);
    }
}
