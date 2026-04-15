<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //This method will show admin login page
  public function index(){
    return view('admin.login');
  }

//this authenticate admin
  public function authenticate(Request $req){
    $validator = Validator::make($req->all(),[
        'email' => 'required|email',
        'password' => 'required'

            ]);
    if($validator->passes()){   

        if(Auth::guard('admin')->attempt(['email'=>$req->email,'password'=>$req->password])){

            if(Auth::guard('admin')->user()->role != 'admin'){
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', __('messages.not_authorized'));
            }else{
                return redirect()->route('admin.dashboard'); 
            }
        
        }else{
            return redirect()->route('admin.login')->with('error', __('messages.email_or_password_not_correct'));
        }

    }else{
        return redirect()->route('admin.login')
        ->withInput()
        ->withErrors($validator);
    }
}

    //this method will logout admin
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
