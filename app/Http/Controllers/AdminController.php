<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AdminController extends Controller
{

    public function create()
    {
        return view('admin.register');
    }

    public function registerAdmin(Request $request)
    {
      $this->validate($request, [
       
       'name'=>  'required',
       'password'=> 'required|min:6|confirmed',
       'profile_image'=>'required',
       'phone'=>'required',
       'username'=>'required'

    ]); 


     Admin::create([
          'name'=>$request->name,
          'password'=>bcrypt($request->password),
          'profile_image'=>$request->profile_image,
          'phone'=>$request->phone,
          'username'=>$request->username
    ]);
      return redirect()->intended('/home/admin');
    }

    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function adminAuth(Request $request)
   {
      $this->validate($request, [
        'username'=>'required',
        'password'=>'required'
      ]);
     $username = $request->username;
     $password = $request->password;
     $remember = $request->remember_token;

     if(Auth::guard('admin')->attempt(['username'=> $username, 'password'=> $password], $remember)){
       return redirect()->intended('/home/admin');
      } else {
         return redirect()->back()->with('warning', 'Invalid Username or Password');
      }
    }

  public function home()
  {
    return view('adminHome');
  }

  public function logout()
  {
    Auth::guard('admin')->logout();

    return redirect('/login/admin'); 
  }

}