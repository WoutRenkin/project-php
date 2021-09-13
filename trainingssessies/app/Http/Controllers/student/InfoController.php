<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class InfoController extends Controller
{
    public function index(){
        if(Auth::user()){
            $user = Auth::user();
            $result = compact("user");
            return view('Profile.edit',$result);
        }
        else{
            return redirect('/logout');
        }

    }
    public function update(Request $request){
        if($request->NewPassword){
            $input = [
                'first_name'   => $request->input('first_name'),
                'last_name'   => $request->input('last_name'),
                'tel'   => $request->input('tel'),
                'OldPassword'   => $request->input('OldPassword'),
                'NewPassword'   => $request->input('NewPassword'),
                'ConfirmPassword'   => $request->input('ConfirmPassword')
            ];
            $rules = [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'tel'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'OldPassword' => ['required', function ($attribute, $value, $fail) {
                    //param1 - user password that has been entered on the form
                    //param2 - old password hash stored in database
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('Het huidige wachtwoord is niet correct'));
                    }
                }],
                'NewPassword' => ['nullable', 'string', 'min:4'],
                'ConfirmPassword' => ['nullable', 'required_with:NewPassword', 'same:NewPassword'],

            ];
            $messages = [
                'ConfirmPassword.same' => 'Het wachtwoord komt niet overeen',
                'NewPassword.min' => 'Het nieuwe wachtwoord moet minimum 4 tekens lang zijn',
                'ConfirmPassword.required_with' => 'Het wachtwoord komt niet overeen',
                'tel.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
                'tel.min' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
            ];
        }
        else{
            $input = [
                'first_name'   => $request->input('first_name'),
                'last_name'   => $request->input('last_name'),
                'OldPassword'   => $request->input('OldPassword'),
                'tel'   => $request->input('tel'),
            ];
            $rules = [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'tel'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'OldPassword' => ['required', function ($attribute, $value, $fail) {
                    //param1 - user password that has been entered on the form
                    //param2 - old password hash stored in database
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('Het huidige wachtwoord is niet correct'));
                    }
                }],

            ];
            $messages = [
                'tel.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
                'tel.min' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
            ];
        }

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->passes()) {
            $user = Auth::user();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->tel = $request->tel;
            if($request->NewPassword) {
                $user->password = Hash::make($request->NewPassword);
            }
            $user->save();
            return response()->json(['success'=>'Je gegevens zijn succesvol aangepast!']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
      /*  $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'NewPassword' => ['nullable', 'string', 'min:4'],
            'tel'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'ConfirmPassword' => ['nullable', 'required_with:NewPassword', 'same:NewPassword'],
            'OldPassword' => ['required', function ($attribute, $value, $fail) {
                //param1 - user password that has been entered on the form
                //param2 - old password hash stored in database
                if (!\Hash::check($value, Auth::user()->password)) {
                    return $fail(__('Het huidige wachtwoord is niet correct'));
                }
            }]
        ],
            [
                'NewPassword.min' => 'Het wachtwoord moet minimum 4 tekens lang zijn',
                'ConfirmPassword.same' => 'Het wachtwoord komt niet overeen',
                'ConfirmPassword.required_with' => 'Het wachtwoord komt niet overeen',
                'tel.regex' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
                'tel.min' => 'Ongeldige telefoon nummer. Voorbeeld: 0477045032 of +32477045032',
            ]);

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->tel = $request->tel;
        $user->password = Hash::make($request->NewPassword);
        $user->save();
        return response()->json(['success'=>'Je gegevens zijn succesvol aangepast!']);

        return redirect('/');*/
    }
}
