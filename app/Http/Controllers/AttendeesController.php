<?php

namespace App\Http\Controllers;

use App\Models\Attendees;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class AttendeesController extends Controller
{
    //
    public function attendees()
    {
        $activeSchoolYear = SchoolYear::where('is_active', true)->first();

        if(!$activeSchoolYear){
            return redirect()->back()->with('error', 'No Active School Year Found!');
        }
        //get attendeesb based on the active school year
        $attendees = Attendees::where('schoolyear_id', $activeSchoolYear->id)->latest()->get();
        
        return view('admin.pages.attendees.attendees', compact('attendees', 'activeSchoolYear'));
    }

    public function createAttendees(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'department' => 'required|string|max:255',
            'program' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',
            'year_level' => 'nullable|string|max:50',
            'grade_level' => 'nullable|string|max:50',
            'track' => 'nullable|string|max:255',
            'strand' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //image File
            'email_add' => 'required|email|unique:attendees,email_add',
            'address' => 'nullable |string|max:255',        
            'mobile_no' => 'required|regex:/^[0-9]{11}$/|unique:attendees,mobile_no',      //ensures that the number is exactly 11
        ]);

        //find the active school year
        $activeSchoolyear = SchoolYear::where('is_active', true)->first();
        if(!$activeSchoolyear){
            return redirect()->back()->with('error', 'No active school year found!');
        }

        //for rollno convert 2024-2025 to 20242025
        $sy_digits = str_replace('-', '', $activeSchoolyear->schoolyear);

        //fuind the last rollno
        $lastAttendee = Attendees::where('schoolyear_id', $activeSchoolyear->id)->orderBy('rollno', 'desc')->first();

        if($lastAttendee)
        {
            //extracts the last6 digits of the rollno converts it to integer and add 1
            $lastNumber = intval(substr($lastAttendee->rollno, -6)) + 1;
        }else{
            $lastNumber = 1;        //starts at 1 if there is no last attendee
        }

        //Format the rollno to 20242025000001
        $newRollno = $sy_digits . str_pad($lastNumber, 6, '0', STR_PAD_LEFT);

        $filename = null;
        if($request->hasFile('img')){
            $filename = time().'.'.$request->img->extension();
            $request->img->move(public_path('images/attendees'), $filename);
        }

        try{
            Attendees::create([
                'rollno' => $newRollno,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'department' => $request->department,
                'program' => $request->program,
                'major' => $request->major,
                'year_level' => $request->year_level,
                'grade_level' => $request->grade_level,
                'track' => $request->track,
                'strand' => $request->strand,
                'section' => $request->section,
                'img' => $filename,
                'email_add' => $request->email_add,
                'address' => $request->address,
                'mobile_no' => $request->mobile_no,
                'schoolyear_id' => $activeSchoolyear->id
            ]); 
            return redirect()->back()->with('success_adding_student', 'Attendee created successfully!');
        }catch(\Exception $e){
            return redirect()->route('manage_attendees')->with('error', 'Something went wrong, please try again!' . $e->getMessage());
        }
     
        

    }

    public function displayRollNo()
    {
        //get the active school year first
        $activeSchoolYear = SchoolYear::where('is_active', true)->first();
        if(!$activeSchoolYear)
        {
            return redirect()->back()->with('error', 'No active School Year found!');
        }

        //extracts digits from th school year
        $sy_digits = str_replace('-', '', $activeSchoolYear->schoolyear);

        //get the latest roll number for the ative school  year (filters the rollnumer bse on the active schoolyear)
        $lastRollNo = Attendees::where('schoolyear_id', $activeSchoolYear->id)->max('rollno');

        //generate new rollnumber
        $lastNumber = $lastRollNo ? intval(substr($lastRollNo, -6)) + 1 : 1;
        $newRollNo = $sy_digits . str_pad($lastNumber, 6, '0', STR_PAD_LEFT);

        //
        //dd($newRollNo);
        return response()->json(['rollno' => $newRollNo]);

        // return view('admin.pages.attendees.attendees-modals.add-student-attendees', compact('newRollNo', 'activeSchoolYear'));
    }

}
