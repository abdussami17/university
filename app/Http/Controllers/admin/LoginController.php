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
public function authenticate(Request $req)
{
    $validator = Validator::make($req->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ], [
        'email.required' => 'E-Mail ist erforderlich.',
        'email.email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
        'password.required' => 'Passwort ist erforderlich.',
    ]);

    if ($validator->passes()) {

        if (Auth::guard('admin')->attempt([
            'email' => $req->email,
            'password' => $req->password
        ])) {

            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')
                    ->with('error', 'Sie sind nicht berechtigt, auf diese Seite zuzugreifen.');
            } else {
                return redirect()->route('admin.dashboard');
            }

        } else {
            return redirect()->route('admin.login')
                ->withInput()
                ->with('error', 'E-Mail oder Passwort ist falsch.');
        }

    } else {
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
