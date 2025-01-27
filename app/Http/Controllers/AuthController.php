<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(){
        return view('admin.auth.login');
    }

    public function register(){
        return view('admin.auth.register');
    }

    public function registerAdmin(Request $request){
        $request->validate ([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $admin = new User();

        $admin->name = $request->fullname;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->usertype = '0'; // 0 for admin, 1 for user
    

    if($admin->save()){
        return redirect(route('admin_login'))->with('success', 'You have been successfully registered!');
    }
    return back()->with('error', 'Something went wrong, please try again!');
    }

    public function loginAdmin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin_login = $request->only('username', 'password');
            if(Auth::attempt($admin_login)){
                return redirect()->intended(route('admin_dashboard'));
            }
            return redirect(route('admin_login'))->with('error', 'Invalid username or password!');
        
    }


    //dashboard view
    public function dashboard(){
        return view('admin.dashboard');
    }
}