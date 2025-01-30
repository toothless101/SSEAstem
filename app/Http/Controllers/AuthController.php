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
        $admin->usertype = '1'; // 1 for admin, 2 for student officer
    

    if($admin->save()){
        return redirect(route('admin_login'))->with('success', 'You have been successfully registered!');
    }
    return back()->with('error', 'Something went wrong, please try again!');
    }

    //admin Login
    public function loginAdmin(Request $request){
        
        //validate login credentials
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //attempt to log the user with the provided credentials
        $admin_login = $request->only('username', 'password');
           
        // if(Auth::attempt($admin_login)){
        //         return redirect()->intended(route('admin_dashboard'));
        //     }
        //     return redirect(route('admin_login'))->with('error', 'Invalid username or password!');
        
        
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
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    //dashboard view
    public function dashboard(){
        return view('admin.dashboard');
    }

    //officer
    public function officer(){
         $users = User::latest()->get();
        return view('admin/pages/officer.officer', compact('users'));
    }

    //ADD OFFICER
    public function createOfficer(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'password' => 'required|min:6',
            'usertype' => 'required|integer|in:1,2',
            'user_img'=>'nullable|image|max:2048'

        ]);

        if($request->hasFile('user_img')){
            $filename = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('images'), $filename);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'usertype' => $request->usertype,
                'user_img' => $filename
            ]);

            return redirect()->back()->with('success', 'Officer created successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong, please try again!' . $e->getMessage());
        }

    }

    public function showOfficer(Request $request, $user)
    {
        $user = User::find($user);
        return view('admin.posts.officer-modals.officer_profile', compact('user'));
    }

    public function updateOfficer(Request $request, $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            // 'password' => 'required|min:6',
            'usertype' => 'required|integer|in:1,2',
            'user_img'=>'nullable|image|max:2048'
        ]);

        $filename = '';
        if($request->hasFile('user_img')){
            $filename = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('images'), $filename);
        }

        $user = User::find($user);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        // $user->password = bcrypt($request->password);
        $user->usertype = $request->usertype;
        // $user->user_img = $filename;

        if(!empty($filename)){
            $user->user_img = $filename;
        }

        $user->save();

        return redirect()->route('manage_officer')->with('success_update', 'Officer updated successfully!');
    }
}