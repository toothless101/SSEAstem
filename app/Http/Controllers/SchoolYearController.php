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
                'schoolyear' => $request->schoolyear,
                'is_active' => false  //default to inactive
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

        $request->validate([
            'schoolyear' => 'required|unique:schoolyears,schoolyear'
        ]);

        $schoolyear = SchoolYear::find($schoolyear);

        $schoolyear->schoolyear = $request->schoolyear;

        $schoolyear->update();

        return redirect()->route('manage_schoolyear')->with('success_update_sy', 'School Year Updated Successfully');
    }

    //toggle the activation of a school year
    public function toggleActive($schoolyear)
    {
        $schoolyear = SchoolYear::find($schoolyear);

        try{
            //deactivate other active school year if activating an new one
            if($schoolyear->is_active == false){
                SchoolYear::where('is_active', true)->update(['is_active' => false]);
            }

            //toggle current schoolyear's status
            $schoolyear->is_active = !$schoolyear->is_active;
            $schoolyear->update();

            // return redirect()->back()->with('success_toggle_sy', 'School Year Activated Successfully');
            return response()->json(["success" => true, 'status' => $schoolyear->is_active]);
        } catch(\Exception $e){
            // return redirect()->back()->with('error_toggle_sy', 'Something went wrong, please try again!' .$e->getMessage());
            return response()->json(["success" => false, 'error' => $schoolyear->is_active]);
        }
    } 
}
