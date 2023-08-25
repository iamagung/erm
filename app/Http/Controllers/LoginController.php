<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth, Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function formlogin(){
        return view('login');
    }

    public function dologin(Request $request){
        $data['username'] = strip_tags($request->email);
        $data['password'] = strip_tags($request->password);
        $cek = Auth::attempt($data);

        if($cek){
            if(Auth::user()->level == 1 ){
                return redirect()->route('dashboardAdmin');
            }else if(Auth::user()->level == 2 ){
                // return redirect()->route('dashboard');
                return redirect()->route('dataRegistrasi');
            }else{
                // return redirect()->route('dashboardPerawat');
                return redirect()->route('dataRegistrasiPerawat');
            }
        }else{
            return redirect()->route('login')->with('title', 'Peringatan !')->with('message', 'Username/email & Password Salah')->with('type', 'error');
        }
    }
}
