<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminPage()
    {
        $users = User::where('usertype', 1)->get();
        return view('admin.pages.officer.admin', compact('users'));
    }

    public function createAdmin(Request $request)
    {
        $request->validate ([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'user_img' => 'nullable|image|max:2048'
        ]);

        //hadnle image upload
        $filename = 'default.png';
        if($request->hasFile('user_img')){
            $filename = time().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('images/admin'), $filename);
        }
         
        try{
            $adminUsertype = '1';
            $admin = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' =>$request->email,
                'username' => $request->username,
                'password' =>bcrypt($request->password),
                'usertype' => $adminUsertype,
                'user_img' => $filename
            ]);

            return redirect()->back()->with('success_adding_admin', 'Admin created successfully!');
        }catch(\Exception $e){
            return redirect()->route('admin_page')->with('error_adding_admin', 'Something went wrong, please try again!' . $e->getMessage());
        }

    } 
}
