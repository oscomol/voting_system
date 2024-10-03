<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthCtrl extends Controller
{
    public function login(Request $request){

        $role = $request->segment(2); 
      
        if ($request->isMethod('post')) {

            $user = [
                'lrn' => $request->lrn,
                'password' => $request->password
            ];

            if (Auth::attempt($user)) {
                if(auth()->user()->userType == "student"){
                    return redirect('/student');
                }
                return redirect('/administrator/dashboard');
            }
    
            return back()->with('error', true);
        }

        if($role == "admin"){
            return view('pages.auth.adminLogin'); 
        }
    
        return view('pages.auth.login');
    }  
    
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
