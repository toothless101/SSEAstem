<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    //
    public function schoolyear(){
        return view('admin.pages.school-year.school-year');
    }
}
