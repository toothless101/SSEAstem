<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class OfficerController extends Controller
{
    //


    //officer
    public function officer()
    {
        $activeSchoolyear = SchoolYear::where('is_active', true)->first();

        if(!$activeSchoolyear){
            return redirect()->back()->with('error', 'No School Year Found!');
        }

        //get officers based on the active schoolyear
         $users = User::where('usertype', 2)
         ->whereHas('userSchoolyears', function($query) use ($activeSchoolyear){
            $query->where('schoolyear_id', $activeSchoolyear->id);
         })->latest()->get();

        return view('admin/pages/officer.officer', compact('users'));
    }

    //ADD OFFICER
    public function createOfficer(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|unique:users,email|email',
            'username' => 'required|string|unique:users,username|max:255',
            // 'usertype' => 'required|integer|in:1,2',
            'org_type' => 'required|integer|in:1,2',
            'user_img'=>'nullable|image|max:2048'

        ]);

        //get active schoolyear
        $activeSchoolyear = SchoolYear::where('is_active', true)->first();
        if(!$activeSchoolyear){
            return redirect()->back()->with('error', 'No Active School Year Found!');
        }
        //handle image upload
        $filename = 'default.png'; //default image if there is no image upldoaded
        if($request->hasFile('user_img')){
            $filename = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('images/'), $filename);
        }

        try {
            $officerUsertype = '2';
            $defaultPassword = bcrypt('1');
            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $defaultPassword,
                'usertype' => $officerUsertype,
                'org_type' => $request->org_type,
                'user_img' => $filename
            ]);                         
                   
            if (!$user) {
                return redirect()->back()->with('error', 'User creation failed!');
            }
    
            // Check if user is already assigned to the school year
            $exists = DB::table('user_schoolyear')
                ->where('user_id', $user->id)
                ->where('schoolyear_id', $activeSchoolyear->id)
                ->exists();
    
            if (!$exists) {
                // Attach user to schoolyear
                DB::table('user_schoolyear')->insert([
                    'user_id' => $user->id,
                    'schoolyear_id' => $activeSchoolyear->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success_add', 'Officer created successfully!');
        }catch(\Exception $e){
            return redirect()->route('manage_officer')->with('error', 'Something went wrong, please try again!' . $e->getMessage());
        }

    }

    public function showOfficer(Request $request, $user)
    {
        $user = User::findOrFail($user);
        return view('admin.posts.officer-modals.officer_profile', compact('user'));
    }


    public function editOfficer(Request $request, $user)
    {
        //dd($user);
        $user = User::find($user);
        return view('admin.pages.officer.officer-modals.edit-officers', compact('user'));// ['user' => $user]);
    }

    public function updateOfficer(Request $request, $user)
    {

        $user = User::find($user);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->usertype = $request->usertype;
        $user->org_type = $request->org_type;

        if($request->hasFile('user_img')){
            
            $destination = 'images/'.$user->user_img;
            if(File::exists($destination)){                          //deletes the file or image
                File::delete($destination);
            }
          
            $file= $request->file('user_img');                        //upload new image
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/', $filename);
            $user->user_img = $filename;
        }

        $user->update();

        return redirect()->route('manage_officer')->with('success_update', 'Officer Updated Successully!');
    }

    public function deleteOfficer(Request $request, $user)
    {
        $user = User::find($user);

        if($user->user_img){
            $img_path = public_path('images/' . $user->user_img);
            if(file_exists($img_path)){
                unlink($img_path);    //delete the image of the deleleted user 
           }
        }
        $user->delete();
        return redirect()->route('manage_officer')->with('success', 'Officer Deleted Successfully!');
    }


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


