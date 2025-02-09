<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    //

    public function officerProfile($user){
        $officer = User::find($user);

       if($officer){
           return view('admin.pages.officer.officer-modals.officer_profile', compact('officer'));
       }else{
           return back()->with('error', 'Officer not found!');
       }
    }

    public function officerLogin(){
        return view('student-officer.auth.login');
    }
}


