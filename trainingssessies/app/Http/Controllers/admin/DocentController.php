<?php

namespace App\Http\Controllers\admin;

use App\Docent;
use App\Http\Controllers\Controller;
use App\SessionToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocentController extends Controller
{
    public function index(){

        $token = SessionToken::first();
        $result = compact('token');
        return view('admin/docenten.index',$result);
    }

    public function reset(){

        $token = SessionToken::first();
        $token->token = Str::random(10);
        $token->save();
        return redirect('admin/docents');
    }
}
