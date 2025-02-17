<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    //
    public function schoolyear(){   
        $schoolyears = Schoolyear::latest()->get();   //display to the table
        return view('admin.pages.school-year.school-year', compact('schoolyears'));
    }

    public function createSchoolYear(Request $request)
    {

        $request->validate([
            'schoolyear' => 'required|unique:schoolyears,schoolyear'
        ]);

        try{
            SchoolYear::create([
                'schoolyear' => $request->schoolyear
            ]);
            return redirect()->back()->with('success_add_sy', 'School Year Created Successfully!');
        }catch(\Exception $e){
            return redirect()->route('manage_schoolyear')->with('error_add_sy', 'Something went wrong, please try again!' .$e->getMessage());
        }
    }

    public function editSchoolYear(Request $request, $schoolyear)
    {   
        $schoolyear = SchoolYear::find($schoolyear);
        return view('admin.pages.school-year.schoolyear-modal.edit-schoolyear', compact('schoolyear'));
    }

    public function updateSchoolYear(Request $request, $schoolyear)
    {
        $schoolyear = SchoolYear::find($schoolyear);

        $schoolyear->schoolyear = $request->schoolyear;

        $schoolyear->update();

        return redirect()->route('manage_schoolyear')->with('success_update_sy', 'School Year Updated Successfully');
    }
}
