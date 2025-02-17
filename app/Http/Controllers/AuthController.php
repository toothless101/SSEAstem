<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('admin.auth.login');
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerAdmin(Request $request)
    {
        $request->validate ([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
        ]);

        $admin = new User();

        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->usertype = '1'; // 1 for admin, 2 for student officer
    

        if($admin->save()){
            return redirect(route('admin_login'))->with('success', 'You have been successfully registered!');
        }
        return back()->with('error', 'Something went wrong, please try again!');
    }

    //admin Login
    public function loginAdmin(Request $request)
    {
        
        //validate login credentials
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //attempt to log the user with the provided credentials
        $admin_login = $request->only('username', 'password');

        
        if(Auth::attempt($admin_login)){
            
            if(Auth::user()->usertype=='1'){ //if the usertype is 1 or admin then directed  to admin dashboard.
                return redirect()->intended(route('admin_dashboard'));
            }
            else {
                Auth::logout();
                return redirect(route('admin_login'))->with('error', 'Only Admin can Access!');
            }
        }

        return redirect(route('admin_login'))->with('error', 'Invalid username or password!');
    }

    //logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //dashboard view
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //ADMIN PAGE
    public function adminPage()
    {
        $users = User::where('usertype', 1)->get();
        return view('admin.pages.officer.admin', compact('users'));
    }


    //STUDENT OFFICER AUTH
    public function studentAuthForm(){
        return view('student-officer.auth.student-login');
    }

    public function studentOfficerLogin(Request $request)
    {

    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $student_login = $request->only('username', 'password');

    if (Auth::attempt($student_login)) {
        if (Auth::user()->usertype == '2') { // if the usertype is 2 or student officer then directed to student officer dashboard.
            return redirect()->intended(route('student_officer_dashboard'));
        } else {
            Auth::logout();
            return redirect(route('student_officer_login'))->with('error', 'Only Student Officers can Access!');
        }
    }

    return redirect(route('student_officer_login'))->with('error', 'Invalid username or password!');
    }

    public function student_officer_dashboard(){
        return view('student-officer.pages.std_officer_dashboard');
    }

    public function studentOfficerLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}